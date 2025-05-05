<?php

use App\Http\Controllers\TweetController;
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
