<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\CompanyContent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener productos destacados (últimos 6)
        $featuredProducts = Product::where('is_active', true)
            ->where('stock', '>', 0)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Obtener recetas populares (últimas 3)
        $popularRecipes = Recipe::where('is_active', true)
            ->orderBy('created_at', 'desc')  
            ->take(3)
            ->get();

        // Obtener categorías principales
        $mainCategories = Category::where('is_active', true)
            ->whereNotNull('parent_id') // Solo subcategorías
            ->take(4)
            ->get();

        // Obtener contenido hero desde CompanyContent
        $heroContent = CompanyContent::where('type', 'hero')
            ->where('is_active', true)
            ->first();

        // Estadísticas de la empresa
        $stats = [
            'years_experience' => 20,
            'products_count' => Product::where('is_active', true)->count(),
            'recipes_count' => Recipe::where('is_active', true)->count(),
            'categories_count' => Category::where('is_active', true)->count(),
        ];

        return view('home.index', compact(
            'featuredProducts',
            'popularRecipes', 
            'mainCategories',
            'heroContent',
            'stats'
        ));
    }
}
