<?php

namespace App\Jobs;

use App\Models\Map;
use App\Models\MapItem;
use App\Models\MapObject;
use App\Models\MapTextItem;
use App\Models\War;
use App\ObjectType;
use App\Services\Map\Points\WarApiPoint;
use App\Services\Map\RegionHex;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateMapObjectsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const     IS_VICTORY_BASE = '1';
    const     IS_BUILD_SITE = '4';
    const     IS_SCORCHED = '10';
    const     IS_TOWN_CLAIMED = '20';

    /**
     * @var \App\Models\Map
     */
    private Map $map;
    /**
     * @var \App\Models\War|null
     */
    private ?War $war;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\Map $map
     */
    public function __construct(string $hexName)
    {
        $this->map = Map::whereHexName($hexName)->first();
        $this->war = War::getCurrentWar() ?? null;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // 1.generate Objects if missing
        $mapItems = $this->map->mapItems()->whereNull('map_object_id')->get();
        if ($mapItems) {
            $this->assignMapObjects($mapItems);
        }
        // 2. update objects with mapItem data
        $this->map->load('mapItems.mapObject');

        $this->map->mapItems->each(function (MapItem $mapItem) {
            $mapObject = $mapItem->mapObject;
            if (
                $mapItem->team_id != $mapObject->team_id ||//Town Owner Changed
                $mapItem->icon_type != $mapObject->icon_type ||//Town Level changed
                ($mapItem->flags & self::IS_BUILD_SITE) != $mapObject->is_build_site ||//Object build status changed
                ($mapItem->flags & self::IS_VICTORY_BASE) != $mapObject->is_victory_base ||//shouldn`t change...
                ($mapItem->flags & self::IS_SCORCHED) != $mapObject->is_scorched//Got hit by a rocket :D
            ) {
                $mapObject->update([
                    'team_id'         => $mapItem->team_id,
                    'icon_type'       => $mapItem->icon_type,
                    'object_type'     => ObjectType::from($mapItem->icon_type),
                    'is_scorched'     => $mapItem->flags & self::IS_SCORCHED,
                    'is_victory_base' => $mapItem->flags & self::IS_VICTORY_BASE,
                    'is_build_site'   => $mapItem->flags & self::IS_BUILD_SITE,
                ]);
            }
        });
    }

    /**
     * @param \Illuminate\Database\Eloquent\Collection $mapItems
     */
    public function assignMapObjects(Collection $mapItems): void
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
                'is_scorched'     => $mapItem->flags & self::IS_SCORCHED,
                'is_victory_base' => $mapItem->flags & self::IS_VICTORY_BASE,
                'is_build_site'   => $mapItem->flags & self::IS_BUILD_SITE,
            ]);
            $mapItem->mapObject()->associate($mapObject)->save();
        });
    }

    /**
     * @param \App\Models\MapItem $mapItem
     *
     * @return MapTextItem
     */
    private function findClosestMapTextItem(MapItem $mapItem): MapTextItem
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
