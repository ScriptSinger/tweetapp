<?php

namespace App\Events;

use App\Models\Tweet;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TweetCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $tweet;

    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {

        return new Channel('tweets');
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->tweet->id,
            'username' => $this->tweet->username,
            'content' => $this->tweet->content,
            'category' => [
                'id' => $this->tweet->category->id,
                'title' => $this->tweet->category->title,
            ],
            'created_at' => $this->tweet->created_at
        ];
    }
}
