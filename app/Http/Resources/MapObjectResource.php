<?php

namespace App\Http\Resources;

class MapObjectResource extends Resource
{
    public function data($request): array
    {
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
            'x'               => $this->x,
            'y'               => $this->y,
        ];
    }
}
