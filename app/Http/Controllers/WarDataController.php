<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use App\Models\Map;
use App\Models\WarData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WarDataController extends Controller
{

    public function loadWarData()
    {
        $warData = WarData::first();

        return view('warData.show', compact('warData'));
    }

    public function loadMaps()
    {
        /** @var \Illuminate\Http\Client\Response $response1 */
        $response1 = Http::get('https://war-service-live.foxholeservices.com/api/worldconquest/maps');
        $mapData = collect($response1->json());
        $mapData->each(function ($mapName) use(&$maps) {
            $map = Map::where('name',$mapName)->first();

            $response2 = Http::withHeaders(['If-None-Match' =>  $map->e_tag ?? '"0"'])
                             ->get('https://war-service-live.foxholeservices.com/api/worldconquest/warReport/' . $mapName);
            if($response2->status() === 304){
                return;
            }
            dump('ohhhh');
            $warReportData = collect($response2->json());
            Map::updateOrCreate([
                'name' => $mapName,
            ], array_merge($warReportData->toArray(),['e_tag' => $response2->header('ETag')]));
        });
//        dd($maps);

        $maps = Map::all();

        return view('maps.show', compact('maps'));
    }
}
