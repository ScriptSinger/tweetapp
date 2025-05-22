<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTweetRequest;
use App\Jobs\CreateTweetJob;
use App\Models\Category;
use App\Models\Tweet;

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

    public function store(StoreTweetRequest $request)
    {
        CreateTweetJob::dispatch($request->validated());

        return response()->json(['status' => 'queued'], 202);
    }
}
