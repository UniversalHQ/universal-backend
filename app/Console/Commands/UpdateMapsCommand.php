<?php

namespace App\Console\Commands;

use App\Jobs\UpdateMapJob;
use App\Models\Map;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateMapsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

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
        /** @var \Illuminate\Http\Client\Response $mapsResponse */
        $mapsResponse = Http::get('https://war-service-live.foxholeservices.com/api/worldconquest/maps');
        $mapData = collect($mapsResponse->json());

        $mapData->each(function ($mapName) use(&$maps) {
            UpdateMapJob::dispatch($mapName);
        });
        //        dd($maps);

        $maps = Map::all();



        return 0;
    }
}
