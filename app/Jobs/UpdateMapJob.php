<?php

namespace App\Jobs;

use App\Models\Map;
use App\Models\War;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UpdateMapJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $hexName;

    /**
     * Create a new job instance.
     *
     * @param $hexName
     */
    public function __construct($hexName)
    {
        $this->hexName = $hexName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $map = Map::where('hex_name', $this->hexName)->first();

        $response2 = Http::withHeaders(['If-None-Match' => $map->e_tag ?? '"0"'])
                         ->get('https://war-service-live.foxholeservices.com/api/worldconquest/warReport/' . $this->hexName);

        if ($response2->status() === 304) {
            logger()->info($map->name . ' Has not been updated');

            return;
        }
        $map->e_tag = $response2->header('ETag');
        $map->save();

        War::getCurrentWar()->mapWarReports()->create(array_merge([
            'name'   => $this->hexName,
            'map_id' => $map->id,
        ],
            $response2->json(),
        ));
        logger()->info($map->name . ' Has been updated');
    }
}
