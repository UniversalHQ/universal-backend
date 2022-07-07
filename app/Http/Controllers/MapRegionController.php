<?php

namespace App\Http\Controllers;

use App\Http\Resources\MapResource;
use App\Models\Map;
use App\Models\MapObject;
use Illuminate\Http\Request;

class MapRegionController extends Controller
{
    public function indexMap(Request $request)
    {
        $query = Map::query();
        if ($regionId = $request->get('region_id')) {
            $query->where('region_id', $regionId);
        }

        return MapResource::collection($query->get());
    }
}
