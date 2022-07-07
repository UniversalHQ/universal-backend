<?php

namespace App\Http\Resources;

use App\Services\Map\Points\RegionCenterPoint;
use App\Services\Map\RegionHex;
use Illuminate\Http\Request;

class MapResource extends Resource
{

    public function data(Request $request): array
    {
        $regionCenterPoint = new RegionCenterPoint(RegionHex::from($this->region_id));
        return [
            'region_id' => $this->region_id,
            'name'      => $this->name,
            'center'    => [
                'lat' => $regionCenterPoint->y,
                'lng' => $regionCenterPoint->x,
            ],
        ];
    }
}
