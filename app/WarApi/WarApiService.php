<?php

namespace App\WarApi;

use App\Jobs\UpdateStaticMapDataJob;
use App\Jobs\UpdateWarReportForMapJob;
use App\Models\Map;
use App\Models\MapItem;
use App\Models\MapTextItem;
use App\Models\War;
use App\Services\Map\Points\WarApiPoint;
use App\Services\Map\RegionHex;
use Illuminate\Support\Carbon;

class WarApiService
{
    public function __construct(private WarApiClient $warApiClient)
    {
    }

    public function updateWar()
    {
        $dataArray = $this->warApiClient->getWarData();
        $warId = array_shift($dataArray);
        /** @var War */
        $war = War::updateOrCreate(['war_id' => $warId, 'id' => $dataArray['warNumber']], [
            'war_number'             => $dataArray['warNumber'],
            'required_victory_towns' => $dataArray['requiredVictoryTowns'],
            'winner'                 => $dataArray['winner'],
            'conquest_start_time'    => $dataArray['conquestStartTime'],
            'started_at'             => $dataArray['conquestStartTime']
                ? Carbon::createFromTimestampMsUTC($dataArray['conquestStartTime'])
                : null,
            'conquest_end_time'      => $dataArray['conquestEndTime'],
            'ended_at'               => $dataArray['conquestEndTime']
                ? Carbon::createFromTimestampMsUTC($dataArray['conquestEndTime'])
                : null,
            'resistance_start_time'  => $dataArray['resistanceStartTime'],
            'resistance_at'          => $dataArray['resistanceStartTime']
                ? Carbon::createFromTimestampMsUTC($dataArray['resistanceStartTime'])
                : null,
        ]);
        if (count($war->getChanges()) || $war->wasRecentlyCreated) {
            $mapsArray = $this->warApiClient->getMapsData();
            if ($war->ended_at) {
                $war->active_resistance_tiles_string = implode($mapsArray);
            } else {
                $war->active_tiles_string = implode($mapsArray);
            }
            $war->save();
            if ($war->wasRecentlyCreated) {
                MapItem::query()->delete();
                MapTextItem::query()->delete();
            }
        }
    }


    public function updateMaps()
    {
        $mapsData = $this->warApiClient->getMapsData();
        $freshTilesString = implode($mapsData);

        $activeTilesString = War::getCurrentWar()->active_tiles_string ?? '';

        if ($activeTilesString != $freshTilesString) {
            $this->updateWar();
            Map::whereIn('hex_name', $mapsData)->update(['active' => true]);
            Map::whereNotIn('hex_name', $mapsData)->update(['active' => false]);
            Map::active()->get()->each(function (Map $map) {
                UpdateStaticMapDataJob::dispatch($map->hex_name);
            });
        }

        collect($mapsData)->each(function ($mapName) {
            UpdateWarReportForMapJob::dispatch($mapName);
        });
    }

    public function updateWarReportForMap(string $hexName)
    {
        $map = Map::where('hex_name', $hexName)->first();

        $reportData = $this->warApiClient->getWarReportForMap($map);

        War::getCurrentWar()->mapWarReports()->create(
            array_merge([
                'name'   => $hexName,
                'map_id' => $map->id,
            ],
                $reportData,
            )
        );
    }

    public function updateDynamicMapData($hexName): bool
    {
        $map = Map::whereHexName($hexName)->first();

        $result = $this->warApiClient->getDynamicMapData($map);
        if ($result === false) {
            return false;
        }
        if (isset($result['mapTextItems'])) {
            $this->updateMapTextItems($result['mapTextItems'], $map);
        }
        if (isset($result['mapItems'])) {
            $this->updateMapItems($result['mapItems'], $map);
        }

        return true;
    }

    public function updateStaticMapData($hexName): bool
    {
        /** @var Map $map */
        $map = Map::whereHexName($hexName)->first();

        $result = $this->warApiClient->getStaticMapData($map);
        if ($result === false) {
            return false;
        }

        if (isset($result['mapTextItems'])) {
            $this->updateMapTextItems($result['mapTextItems'], $map);
        }
        if (isset($result['mapItems'])) {
            $this->updateMapItems($result['mapItems'], $map);
        }

        return true;
    }

    /**
     * @param $mapTextItems
     * @param $map
     * @return void
     */
    private function updateMapTextItems(array $mapTextItems, Map $map): void
    {
        foreach ($mapTextItems as $mapTextItem) {
            $leafletPoint = (new WarApiPoint($mapTextItem['y'], $mapTextItem['x'], RegionHex::from($map->region_id)))->getLeafletPoint();
            MapTextItem::updateOrCreate([
                'map_id' => $map->id,
                'x'      => $mapTextItem['x'],
                'y'      => $mapTextItem['y'],
            ], [
                'lat'             => $leafletPoint->y,
                'lng'             => $leafletPoint->x,
                'text'            => $mapTextItem['text'],
                'map_marker_type' => $mapTextItem['mapMarkerType'],
            ]);
        }
    }

    private function updateMapItems(array $mapItems, Map $map): void
    {
        foreach ($mapItems as $mapItem) {
            $leafletPoint = (new WarApiPoint($mapItem['y'], $mapItem['x'], RegionHex::from($map->region_id)))->getLeafletPoint();

            MapItem::updateOrCreate([
                'map_id' => $map->id,
                'x'      => $mapItem['x'],
                'y'      => $mapItem['y'],
            ], [
                'lat'       => $leafletPoint->y,
                'lng'       => $leafletPoint->x,
                'team_id'   => $mapItem['teamId'],
                'icon_type' => $mapItem['iconType'],
                'flags'     => $mapItem['flags'],
            ]);
        }
    }
}
