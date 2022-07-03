<?php

namespace App\Jobs;

use App\Models\Map;
use App\Models\War;
use App\WarApi\WarApiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UpdateWarReportForMapJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param string $hexName
     */
    public function __construct(protected string $hexName)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(WarApiService $warApiService)
    {
        $warApiService->updateWarReportForMap($this->hexName);
    }
}
