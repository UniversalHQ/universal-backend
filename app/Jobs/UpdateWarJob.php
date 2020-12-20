<?php

namespace App\Jobs;

use App\Models\MapItem;
use App\Models\MapTextItem;
use App\Models\War;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class UpdateWarJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::get('https://war-service-live.foxholeservices.com/api/worldconquest/war');
        $dataArray = $response->json();
        $warId = array_shift($dataArray);
        /** @var War */
        $war = War::updateOrCreate(['war_id' => $warId], [
            'war_number'             => $dataArray['warNumber'],
            'required_victory_towns' => $dataArray['requiredVictoryTowns'],
            'winner'                 => $dataArray['winner'],
            'conquest_start_time'    => $dataArray['conquestStartTime'],
            'started_at'             => $dataArray['conquestStartTime']
                ? Carbon::createFromTimestamp($dataArray['conquestStartTime'])
                : null,
            'conquest_end_time'      => $dataArray['conquestEndTime'],
            'ended_at'               => $dataArray['conquestEndTime']
                ? Carbon::createFromTimestamp($dataArray['conquestEndTime'])
                : null,
            'resistance_start_time'  => $dataArray['resistanceStartTime'],
            'resistance_at'          => $dataArray['resistanceStartTime']
                ? Carbon::createFromTimestamp($dataArray['resistanceStartTime'])
                : null,
        ]);
        if (count($war->getChanges()) || $war->wasRecentlyCreated) {
            $mapsArray = Http::get('https://war-service-live.foxholeservices.com/api/worldconquest/maps')->json();
            if ($war->ended_at) {
                $war->active_resistance_tiles_string = implode($mapsArray);
            } else {
                $war->active_tiles_string = implode($mapsArray);
            }
            $war->save();
            logger()->info('War State changed. Active GameTiles have been updated.');
            if($war->wasRecentlyCreated){
                MapItem::query()->delete();
                MapTextItem::query()->delete();
            }
        } else {
            logger()->info('War State has not changed.');
        }
    }
}
