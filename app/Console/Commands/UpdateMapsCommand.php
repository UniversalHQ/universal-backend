<?php

namespace App\Console\Commands;

use App\Jobs\UpdateMapJob;
use App\Models\Map;
use App\Models\War;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

class UpdateMapsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:update-maps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mapsResponse = Http::get('https://war-service-live.foxholeservices.com/api/worldconquest/maps');

        $activeTilesString = War::orderBy('id', 'desc')->first()->active_tiles_string ?? '';
        $freshTilesString = implode($mapsResponse->json());
        if ($activeTilesString != $freshTilesString) {
            Artisan::call('api:update-war');
            $this->info(Artisan::output());
            Map::whereIn('hex_name', $mapsResponse->json())->update(['active' => true]);
            Map::whereNotIn('hex_name', $mapsResponse->json())->update(['active' => false]);
        }

        collect($mapsResponse->json())->each(function ($mapName) {
            UpdateMapJob::dispatch($mapName);
        });

        $this->info('Map updates dispatched');

        return 0;
    }
}
