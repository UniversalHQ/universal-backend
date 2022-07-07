<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MapTextItemResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'text'            => $this->text,
            'map_marker_type' => $this->map_marker_type,
            'lat'             => $this->lat,
            'lng'             => $this->lng,
        ];
    }
}
