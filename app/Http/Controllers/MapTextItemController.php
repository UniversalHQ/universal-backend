<?php

namespace App\Http\Controllers;

use App\Models\MapTextItem;
use Illuminate\Http\Request;
use App\Http\Controllers\MapTextItemResource;

class MapTextItemController extends Controller
{
    public function indexMapTextItem(Request $request)
    {
        $query = MapTextItem::query();
        if ($map = $request->get('map')) {
            $query->where('map_id', $map);
        }

        return MapTextItemResource::collection($query->get());
    }

    public function showMapTextItem(MapTextItem $mapTextItem, Request $request)
    {
        return MapTextItemResource::make($mapTextItem);
    }
}