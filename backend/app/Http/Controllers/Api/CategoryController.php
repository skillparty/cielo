<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories
     */
    public function index(): JsonResponse
    {
        $categories = Category::with(['media'])
            ->active()
            ->rootCategories()
            ->ordered()
            ->withCount('products')
            ->get();

        return response()->json(['data' => $categories]);
    }

    /**
     * Display the specified category
     */
    public function show(string $id): JsonResponse
    {
        $category = Category::with(['media', 'children'])
            ->active()
            ->withCount('products')
            ->findOrFail($id);

        return response()->json(['data' => $category]);
    }
}
