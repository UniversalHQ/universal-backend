<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Models\MapObject;
use App\Models\War;
use Illuminate\Http\Request;

class WarOverviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $war = War::getCurrentWar();
        $maps = Map::active()->with('warReport')->get();
        $mapObjects = MapObject::where('war_id',$war->id)->get();

        return view('warOverview',compact('war','maps','mapObjects'));
    }
}
