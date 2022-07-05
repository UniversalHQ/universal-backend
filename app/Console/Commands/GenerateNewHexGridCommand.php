<?php

namespace App\Console\Commands;

use App\Services\Map\Points\RegionCenterPoint;
use App\Services\Map\RegionHex;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateNewHexGridCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'frontend:generate-hex';

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
     * @return void
     */
    public function handle()
    {
        $json = [
            "features" => [
            ]
        ];
        foreach (RegionHex::cases() as $regionHex) {
            $regionCenterPoint = new RegionCenterPoint($regionHex);;

            $coords = [];
            /** @var \App\Services\Map\Points\LeafletPoint $leafletPoint */
            foreach ($regionCenterPoint->getRegionCornerPoints() as $leafletPoint) {
                $coords[] = $leafletPoint->toArray();
            }
            $feature = [
                "type"       => "Feature",
                "properties" => [
                    "Region" => $regionHex->name,
                ],
                "geometry"   => [
                    "type"        => "Polygon",
                    "coordinates" => [
                        $coords
                    ]
                ]
            ];
            $json["features"][] = $feature;
        }

        Storage::put('hex.json', json_encode($json, JSON_PRETTY_PRINT));
    }
}
