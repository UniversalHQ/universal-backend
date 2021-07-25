<?php

namespace App\Http\Controllers;

use App\Http\Resources\MapObjectResource;
use App\Models\MapObject;
use Illuminate\Http\Request;

class MapObjectController extends Controller
{
    public function indexMapObject(Request $request)
    {
        $query = MapObject::query();
        if ($war = $request->get('war')) {
            $query->where('war_id', $war);
        }
        if ($map = $request->get('map')) {
            $query->where('map_id', $map);
        }
        if ($team = $request->get('team')) {
            $query->where('team', $team);
        }

        return MapObjectResource::collection($query->get());
    }

    public function showMapObject(MapObject $mapObject, Request $request)
    {
        return MapObjectResource::make($mapObject);
    }
}
