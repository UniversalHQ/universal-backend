<?php

namespace App\Http\Resources;

class MapTextItemResource extends Resource
{

    public function data($request): array
    {
        return [
            'map_id'          => $this->map_id,
            'map_object_id'   => $this->map_object_id,
            'text'            => $this->text,
            'map_marker_type' => $this->map_marker_type,
            'x'               => $this->x,
            'y'               => $this->y,
            'lat'             => $this->lat,
            'lng'             => $this->lng,
        ];
    }
}
