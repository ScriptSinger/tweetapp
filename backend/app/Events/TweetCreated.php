<?php

namespace App\Events;

use App\Models\Tweet;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TweetCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tweet;

    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }

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
            'created_at' => $this->tweet->created_at,
        ];
    }
}
