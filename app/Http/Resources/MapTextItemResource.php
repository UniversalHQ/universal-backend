<?php

namespace App\Http\Resources;

use App\Services\Map\Points\WarApiPoint;
use App\Services\Map\RegionHex;

class MapTextItemResource extends Resource
{

    public function data($request): array
    {
        $leafletPoint = (new WarApiPoint($this->y, $this->x,RegionHex::from($this->map->region_id)))->getLeafletPoint();
        return [
            'map_id'          => $this->map_id,
            'map_object_id'   => $this->map_object_id,
            'text'            => $this->text,
            'map_marker_type' => $this->map_marker_type,
            //'x'               => $this->x - 128,
            //'y'               => $this->y + 128,
            'x'               => $leafletPoint->x,
            'y'               => $leafletPoint->y,
        ];
    }
}
