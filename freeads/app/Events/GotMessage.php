<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GotMessage
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

     public $user;
     public $content;
    public function __construct($user,$content)
    {
        $this->user=$user;
        $this->content=$content;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
       
        return    new PrivateChannel('channel_for_everyone');
        
    }
    public function broadcastAs(){
        return 'GotMessage';
    }

    public function broadcastWith()
    {
        return [
            'user' => $this->user,
            'content' => $this->content,
        ];
    }


}
