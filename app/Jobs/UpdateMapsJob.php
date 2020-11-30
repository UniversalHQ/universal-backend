<?php

namespace App\Jobs;

use App\Models\Map;
use App\Models\War;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

class UpdateMapsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $hexName;

    /**
     * Create a new job instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mapsResponse = Http::get('https://war-service-live.foxholeservices.com/api/worldconquest/maps');

        $activeTilesString = War::orderBy('id', 'desc')->first()->active_tiles_string ?? '';
        $freshTilesString = implode($mapsResponse->json());
        if ($activeTilesString != $freshTilesString) {
            Artisan::call('api:update-war');
            logger()->info(Artisan::output());
            Map::whereIn('hex_name', $mapsResponse->json())->update(['active' => true]);
            Map::whereNotIn('hex_name', $mapsResponse->json())->update(['active' => false]);
        }

        collect($mapsResponse->json())->each(function ($mapName) {
            UpdateWarReportJob::dispatch($mapName);
        });

        logger()->info('Map updates dispatched');
    }
}
