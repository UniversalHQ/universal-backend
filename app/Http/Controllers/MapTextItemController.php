<?php

namespace App\Http\Controllers;

use App\Http\Resources\MapTextItemResource;
use App\Models\MapTextItem;
use Illuminate\Http\Request;

class MapTextItemController extends Controller
{
    public function indexMapTextItem(Request $request)
    {
        $query = MapTextItem::query();
        if ($map = $request->get('map')) {
            $query->where('map_id', $map);
        }
        if ($mapMarkerType = $request->get('mapMarkerType')) {
            $query->where('map_marker_type', $mapMarkerType);
        }

        return MapTextItemResource::collection($query->get());
    }

    public function showMapTextItem(MapTextItem $mapTextItem, Request $request)
    {
        return MapTextItemResource::make($mapTextItem);
    }
}
