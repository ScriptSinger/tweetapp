<?php

use App\Events\TweetCreated;
use App\Http\Controllers\TweetController;
use App\Models\Tweet;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [TweetController::class, 'index'])->name('tweets.index');

Route::get('/test-redis', function () {
    try {
        // Простой тест: записываем и считываем значение из Redis
        Redis::set('test_key', 'Laravel Redis is working!');
        $value = Redis::get('test_key');

        return $value; // Выведет 'Laravel Redis is working!'
    } catch (\Exception $e) {
        return 'Error connecting to Redis: ' . $e->getMessage();
    }
});



Route::get('/test-broadcast', function () {
    $tweet = Tweet::find(1); // Замените 1 на ID существующего твита

    if (!$tweet) {
        return response('Tweet not found', 404);
    }

    broadcast(new TweetCreated($tweet));

    return 'Broadcast sent 111';
});
