<?php

namespace App\Events;

use App\AppUser;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserOffline
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $app_user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(AppUser $app_user)
    {
        $this->user = $app_user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('presence-offline_' . $this->user->id);
    }
}
