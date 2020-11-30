<?php

namespace App\Console\Commands;

use App\Jobs\UpdateDynamicMapDataJob;
use App\Models\Map;
use Illuminate\Console\Command;

class UpdateDynamicMapDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:update-dynamic-data';

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
        $activeMaps = Map::active()->get();

        $activeMaps->each(function (Map $map) {
            UpdateDynamicMapDataJob::dispatch($map->hex_name);
        });

        return 0;
    }
}