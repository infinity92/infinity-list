<?php

namespace App\Events;

use App\Models\Category;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BeforeUpdateCategory
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $category;
    public $attribute;

    /**
     * Create a new event instance.
     *
     * @param Category $category
     * @param array $attribute
     */
    public function __construct(Category $category, array $attribute)
    {
        $this->category = $category;
        $this->attribute = $attribute;
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
