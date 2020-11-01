<?php

namespace App\Console\Commands;

use App\Models\WarData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateWarCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:war';

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
        /** @var \App\Models\WarData $war */
        $war = WarData::where('warId',array_shift($dataArray))->first();
        $war->update($dataArray);
        if ($war->wasChanged()) {
            $this->info('War has been Updated');
        }

        return 0;
    }
}
