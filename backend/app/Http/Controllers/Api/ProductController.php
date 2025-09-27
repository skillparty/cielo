<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index(Request $request): JsonResponse
    {
        $query = Product::with(['category', 'media'])
            ->active()
            ->orderBy('name');

        // Filter by category
        if ($request->has('category_id') && $request->category_id !== 'all') {
            $query->where('category_id', $request->category_id);
        }

        // Filter by featured
        if ($request->boolean('featured')) {
            $query->featured();
        }

        // Filter by price range
        if ($request->has('min_price')) {
            $query->where('base_price', '>=', $request->min_price);
        }
        if ($request->has('max_price')) {
            $query->where('base_price', '<=', $request->max_price);
        }

        // Search by name or description
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sort options
        switch ($request->get('sort', 'name')) {
            case 'price_asc':
                $query->orderBy('base_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('base_price', 'desc');
                break;
            case 'featured':
                $query->orderBy('is_featured', 'desc')->orderBy('name');
                break;
            default:
                $query->orderBy('name');
                break;
        }

        $products = $query->paginate($request->get('per_page', 12));

        return response()->json([
            'data' => $products->items(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ]
        ]);
    }

    /**
     * Display the specified product
     */
    public function show(string $id): JsonResponse
    {
        $product = Product::with(['category', 'media'])
            ->active()
            ->findOrFail($id);

        return response()->json(['data' => $product]);
    }

    /**
     * Get featured products
     */
    public function featured(): JsonResponse
    {
        $products = Product::with(['category', 'media'])
            ->active()
            ->featured()
            ->limit(8)
            ->get();

        return response()->json(['data' => $products]);
    }

    /**
     * Get products by category
     */
    public function byCategory(string $categoryId): JsonResponse
    {
        $category = Category::active()->findOrFail($categoryId);
        
        $products = Product::with(['category', 'media'])
            ->active()
            ->where('category_id', $categoryId)
            ->orderBy('name')
            ->paginate(12);

        return response()->json([
            'data' => $products->items(),
            'category' => $category,
            'meta' => [
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
            ]
        ]);
    }
}
