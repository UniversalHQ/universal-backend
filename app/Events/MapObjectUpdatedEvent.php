<?php

namespace App\Events;

use App\Http\Resources\MapObjectResource;
use App\Models\MapObject;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MapObjectUpdatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param MapObject $mapObject
     */
    public function __construct(private MapObject $mapObject)
    {
    }

    public function broadcastWith(): array
    {
        return (new MapObjectResource($this->mapObject))->resolve();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('general');
    }
}
