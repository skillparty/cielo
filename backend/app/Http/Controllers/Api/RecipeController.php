<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RecipeController extends Controller
{
    /**
     * Display a listing of recipes
     */
    public function index(Request $request): JsonResponse
    {
        $query = Recipe::with(['category', 'media', 'products'])
            ->published()
            ->orderBy('created_at', 'desc');

        // Filter by category
        if ($request->has('category_id') && $request->category_id !== 'all') {
            $query->where('category_id', $request->category_id);
        }

        // Filter by difficulty
        if ($request->has('difficulty')) {
            $query->byDifficulty($request->difficulty);
        }

        // Search by title or summary
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        // Sort options
        switch ($request->get('sort', 'newest')) {
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            case 'difficulty':
                $query->orderBy('difficulty_level', 'asc');
                break;
            case 'time':
                $query->orderByRaw('(prep_time_minutes + cook_time_minutes) asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $recipes = $query->paginate($request->get('per_page', 12));

        return response()->json([
            'data' => $recipes->items(),
            'meta' => [
                'current_page' => $recipes->currentPage(),
                'last_page' => $recipes->lastPage(),
                'per_page' => $recipes->perPage(),
                'total' => $recipes->total(),
            ]
        ]);
    }

    /**
     * Display the specified recipe
     */
    public function show(string $id): JsonResponse
    {
        $recipe = Recipe::with(['category', 'media', 'products.media', 'products.category'])
            ->published()
            ->findOrFail($id);

        return response()->json(['data' => $recipe]);
    }

    /**
     * Get featured recipes
     */
    public function featured(): JsonResponse
    {
        $recipes = Recipe::with(['category', 'media'])
            ->published()
            ->limit(6)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['data' => $recipes]);
    }

    /**
     * Get recipes by difficulty
     */
    public function byDifficulty(string $difficulty): JsonResponse
    {
        $recipes = Recipe::with(['category', 'media'])
            ->published()
            ->byDifficulty($difficulty)
            ->orderBy('title')
            ->paginate(12);

        return response()->json([
            'data' => $recipes->items(),
            'meta' => [
                'current_page' => $recipes->currentPage(),
                'last_page' => $recipes->lastPage(),
                'per_page' => $recipes->perPage(),
                'total' => $recipes->total(),
            ]
        ]);
    }
}
