<?php

namespace App\Http\Resources;

class MapObjectResource extends Resource
{
    public function data($request): array
    {
        return [
            'team_id'         => $this->team_id,
            'text'            => $this->text,
            'object_type'     => $this->object_type->name,
            'is_scorched'     => $this->is_scorched,
            'is_victory_base' => $this->is_victory_base,
            'is_build_site'   => $this->is_build_site,
            'lat'             => $this->lat,
            'lng'             => $this->lng,
            'asset_url'       => $this->asset_url,
            'circles'       => $this->ranges,
            'category'        => $this->category,
        ];
    }
}
