<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'media'])
            ->active();

        // Filtros
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('sku', 'LIKE', '%' . $request->search . '%');
            });
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Ordenamiento
        $sortBy = $request->get('sort', 'name');
        $sortDirection = $request->get('direction', 'asc');

        switch ($sortBy) {
            case 'price':
                $query->orderBy('price', $sortDirection);
                break;
            case 'name':
            default:
                $query->orderBy('name', $sortDirection);
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        // Categorías para filtros
        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->get();

        return view('shop.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        // Verificar que el producto esté activo
        if (!$product->is_active) {
            abort(404);
        }

        $product->load(['category', 'media', 'recipes']);

        // Productos relacionados (misma categoría)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->with('media')
            ->limit(4)
            ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }

    public function category(Category $category)
    {
        // Verificar que la categoría esté activa
        if (!$category->is_active) {
            abort(404);
        }

        $products = Product::where('category_id', $category->id)
            ->active()
            ->with(['category', 'media'])
            ->paginate(12);

        $categories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->get();

        return view('shop.category', compact('category', 'products', 'categories'));
    }
}