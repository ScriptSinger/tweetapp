<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Получить список всех категорий.
     */
    public function index(): JsonResponse
    {
        $categories = Category::all();

        return response()->json([
            'status' => 'success',
            'data' => $categories,
        ]);
    }
}
