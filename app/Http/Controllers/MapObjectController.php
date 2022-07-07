<?php

namespace App\Http\Controllers;

use App\Http\Resources\MapObjectResource;
use App\Models\MapObject;
use App\ObjectType;
use Illuminate\Http\Request;

class MapObjectController extends Controller
{
    public function indexMapObject(Request $request)
    {
        $query = MapObject::query();
        if ($war = $request->get('war')) {
            $query->where('war_id', $war);
        }
        if ($team = $request->get('team')) {
            $query->where('team', $team);
        }
        if ($category = $request->get('category')) {
            $query->whereIn('object_type', ObjectType::casesForCategory($category));
        }

        return MapObjectResource::collection($query->get());
    }

    public function showMapObject(MapObject $mapObject, Request $request)
    {
        return MapObjectResource::make($mapObject);
    }
}
