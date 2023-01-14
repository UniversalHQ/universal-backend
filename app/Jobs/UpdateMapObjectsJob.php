<?php

namespace App\Jobs;

use App\Actions\UpdateMapObjectsAction;
use App\Models\Map;
use App\Models\MapItem;
use App\Models\MapObject;
use App\Models\MapTextItem;
use App\Models\War;
use App\ObjectType;
use App\Services\Map\Points\WarApiPoint;
use App\Services\Map\RegionHex;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateMapObjectsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\Map
     */
    private ?Map $map = null;
    /**
     * @var \App\Models\War|null
     */
    private ?War $war = null;

    public function __construct(protected string $hexName)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UpdateMapObjectsAction $action)
    {
        $action->for($this->hexName)->handle();
    }
}
