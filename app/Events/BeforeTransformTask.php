<?php

namespace App\Events;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BeforeTransformTask
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $category;

    /**
     * Create a new event instance.
     *
     * @param Task $category
     */
    public function __construct(Task $category)
    {
        $this->category = $category;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
