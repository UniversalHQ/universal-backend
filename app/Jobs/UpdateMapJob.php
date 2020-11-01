<?php

namespace App\Jobs;

use App\Models\Map;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UpdateMapJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mapName;

    /**
     * Create a new job instance.
     *
     * @param $mapName
     */
    public function __construct($mapName)
    {
        $this->mapName = $mapName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $map = Map::where('name',$this->mapName)->first();

        $response2 = Http::withHeaders(['If-None-Match' =>  $map->e_tag ?? '"0"'])
                         ->get('https://war-service-live.foxholeservices.com/api/worldconquest/warReport/' . $mapName);

        if($response2->status() === 304){
            return;
        }

        $map = Map::updateOrCreate([
            'name' => $mapName,
        ], array_merge($response2->json(),['e_tag' => $response2->header('ETag')]));

    }
}
