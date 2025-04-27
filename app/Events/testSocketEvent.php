<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class testSocketEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public $post)
    {
        //
    }
    /**
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chan-demo'); /*[
            new PrivateChannel('chan-demo'),
        ];*/
    }
    public function broadcastAs() {
        return 'test.sent';
    }
    
    public function broadcastWith()
    {
        return $this->post;
    }
}
