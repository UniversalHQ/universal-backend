<?php

namespace App\Actions;

use App\Models\Map;
use App\Models\MapItem;
use App\Models\MapObject;
use App\Models\MapTextItem;
use App\Models\War;
use App\ObjectType;
use App\Services\Map\Points\WarApiPoint;
use App\Services\Map\RegionHex;
use Illuminate\Database\Eloquent\Collection;

class UpdateMapObjectsAction
{

    private Map $map;

    public function for(string $hexName)
    {
        $this->map = Map::where('hex_name', $hexName)->first();
        return $this;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->war = War::getCurrentWar();

        // 1.generate Objects if missing
        $mapItems = $this->map->mapItems()->whereNull('map_object_id')->get();
        $this->assignMapObjects($mapItems);

        // 2. update objects with mapItem data
        $this->map->load('mapItems.mapObject');

        $this->map->mapItems->each(function (MapItem $mapItem) {
            $mapObject = $mapItem->mapObject;
            if (
                $mapItem->team_id != $mapObject->team_id ||//Town Owner Changed
                $mapItem->icon_type != $mapObject->icon_type ||//Town Level changed
                $mapItem->isVictoryBase() != $mapObject->is_victory_base ||//shouldn`t change...
                $mapItem->isBuildSite() != $mapObject->is_build_site ||//Object build status changed
                $mapItem->isScorched() != $mapObject->is_scorched//Got hit by a rocket :D
            ) {
                $mapObject->update([
                    'team_id'         => $mapItem->team_id,
                    'icon_type'       => $mapItem->icon_type,
                    'object_type'     => ObjectType::from($mapItem->icon_type),
                    'is_victory_base' => $mapItem->isVictoryBase(),
                    'is_build_site'   => $mapItem->isBuildSite(),
                    'is_scorched'     => $mapItem->isScorched(),
                ]);
            }
        });
    }

    /**
     * @param \Illuminate\Database\Eloquent\Collection $mapItems
     */
    protected function assignMapObjects(Collection $mapItems): void
    {
        $mapItems->each(function (MapItem $mapItem) {
            $matchingTextItem = $this->findClosestMapTextItem($mapItem);
            $leafletPoint = (new WarApiPoint($mapItem->y, $mapItem->x, RegionHex::from($mapItem->map->region_id)))->getLeafletPoint();

            $mapObject = MapObject::create([
                'map_id'          => $mapItem->map_id,
                'war_id'          => $this->war->id,
                'x'               => $mapItem->x,
                'y'               => $mapItem->y,
                'lat'             => $leafletPoint->y,
                'lng'             => $leafletPoint->x,
                'text'            => $matchingTextItem->text,
                'team_id'         => $mapItem->team_id,
                'icon_type'       => $mapItem->icon_type,
                'object_type'     => ObjectType::from($mapItem->icon_type),
                'is_victory_base' => $mapItem->isVictoryBase(),
                'is_build_site'   => $mapItem->isBuildSite(),
                'is_scorched'     => $mapItem->isScorched(),
            ]);
            $mapItem->mapObject()->associate($mapObject)->save();
        });
    }

    /**
     * @param \App\Models\MapItem $mapItem
     *
     * @return MapTextItem
     */
    protected function findClosestMapTextItem(MapItem $mapItem): MapTextItem
    {
        $tDif = [];
        /** @var MapTextItem $textItem */
        foreach ($this->map->mapTextItems as $textItem) {
            $xDif = $mapItem->x - $textItem->x;
            $yDif = $mapItem->y - $textItem->y;
            $tDif[$textItem->id] = sqrt(pow($xDif, 2) + pow($yDif, 2));
        }
        asort($tDif);

        return MapTextItem::find(array_key_first($tDif));
    }
}
