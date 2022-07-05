<?php

namespace App\Http\Resources;

use App\Services\Map\Points\WarApiPoint;

class MapObjectResource extends Resource
{
    public function data($request): array
    {
        //$leafletPoint = (new WarApiPoint($this->y, $this->x,$this->map->region_id))->getLeafletPoint();
        return [
            'map_id'          => $this->map_id,
            'war_id'          => $this->war_id,
            'team_id'         => $this->team_id,
            'text'            => $this->text,
            'object_type'     => $this->object_type->name,
            'icon_type'       => $this->icon_type,
            'is_scorched'     => $this->is_scorched,
            'is_victory_base' => $this->is_victory_base,
            'is_build_site'   => $this->is_build_site,
            'x'               => $this->x + 128,//$leafletPoint->x,
            'y'               => $this->y + 128,//$leafletPoint->y,
        ];
    }
}
