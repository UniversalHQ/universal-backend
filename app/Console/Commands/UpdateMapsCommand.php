<?php

namespace App\Console\Commands;

use App\Jobs\UpdateMapsJob;
use Illuminate\Console\Command;

class UpdateMapsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:update-maps';

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
     * @return void
     */
    public function handle()
    {
        UpdateMapsJob::dispatchNow();
    }
}
