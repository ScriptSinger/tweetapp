<?php

namespace App\Jobs;

use App\Events\TweetCreated;
use App\Models\Tweet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateTweetJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        $tweet = Tweet::create([
            'username' => $this->data['username'],
            'content' => $this->data['content'],
            'category_id' => $this->data['category_id'],

        ]);

        broadcast(new TweetCreated($tweet));
    }
}
