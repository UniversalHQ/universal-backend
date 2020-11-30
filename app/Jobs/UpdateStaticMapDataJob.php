<?php

namespace App\Jobs;

use App\Models\Map;
use App\Models\MapItem;
use App\Models\MapTextItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UpdateStaticMapDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $hexName;

    /**
     * Create a new job instance.
     *
     * @param $hexName
     */
    public function __construct($hexName)
    {
        $this->hexName = $hexName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $map = Map::where('hex_name', $this->hexName)->first();

        $response = Http::withHeaders(['If-None-Match' => $map->static_e_tag ?? '"0"'])
                        ->get('https://war-service-live.foxholeservices.com/api/worldconquest/maps/' . $map->hex_name . '/static');

        if ($response->status() === 304) {
            logger()->info($map->name . ' static data has not been updated');

            return;
        }
        $map->static_e_tag = $response->header('ETag');
        $map->save();

        $dataArray = $response->json();

        if (isset($dataArray['mapTextItems'])) {
            foreach ($dataArray['mapTextItems'] as $mapTextItem) {
                MapTextItem::updateOrCreate([
                    'map_id' => $map->id,
                    'x'      => $mapTextItem['x'],
                    'y'      => $mapTextItem['y'],
                ], [
                    'text'            => $mapTextItem['text'],
                    'map_marker_type' => $mapTextItem['mapMarkerType'],
                ]);
            }
        }
        if (isset($dataArray['mapItems'])) {
            foreach ($dataArray['mapItems'] as $mapItem) {
                MapItem::updateOrCreate([
                    'map_id' => $map->id,
                    'x'      => $mapItem['x'],
                    'y'      => $mapItem['y'],
                ], [
                    'teamId'   => $mapItem['teamId'],
                    'iconType' => $mapItem['iconType'],
                    'flags'    => $mapItem['flags'],
                ]);
            }
        }
        logger()->info($map->name . ' static data has been updated');
    }
}


//"regionId" => 3
//"scorchedVictoryTowns" => 0
//"mapItems" => array:39 [
//    0 => array:5 [
//    "teamId" => "NONE"
//      "iconType" => 20
//      "x" => 0.5536355
//      "y" => 0.609139
//      "flags" => 0
//    ]
//]
//"mapTextItems" => array:42 [
//    0 => array:4 [
//    "text" => "Abandoned Ward"
//    "x" => 0.4065897
//    "y" => 0.4973474
//    "mapMarkerType" => "Major"
//  ]
//]
//"lastUpdated" => 1605732599974
//"version" => 1281