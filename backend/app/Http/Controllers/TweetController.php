<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessTweet;
use App\Models\Category;
use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{

    public function index()
    {
        $tweets = Tweet::with('category')->latest()->get();
        $categories = Category::all();

        return response()->json([
            'tweets' => $tweets,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'username' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $tweet = Tweet::create($request->all());

        // Публикуем сообщение в очередь
        dispatch(new ProcessTweet($tweet));

        return response()->json($tweet, 201);
    }
}
