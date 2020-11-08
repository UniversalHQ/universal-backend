<?php

namespace App\Console\Commands;

use App\Models\War;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class UpdateWarCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:update-war';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
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
            $mapsResponse = Http::get('https://war-service-live.foxholeservices.com/api/worldconquest/maps');
            if ($war->ended_at) {
                $war->active_resistance_tiles_string = implode($mapsResponse->json());
            } else {
                $war->active_tiles_string = implode($mapsResponse->json());
            }
            $war->save();
            $this->info('War State changed. Active GameTiles have been updated.');
        } else{
            $this->info('War State hasn`t changed.');
        }

        return 0;
    }
}