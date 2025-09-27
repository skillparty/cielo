<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::with(['category', 'media', 'products'])
            ->where('is_published', true);

        // Filtros
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('summary', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('difficulty')) {
            $difficultyLevels = [];
            foreach ($request->difficulty as $diff) {
                switch ($diff) {
                    case 'Fácil': $difficultyLevels[] = 1; break;
                    case 'Media': $difficultyLevels[] = 2; break;
                    case 'Difícil': $difficultyLevels[] = 3; break;
                }
            }
            $query->whereIn('difficulty_level', $difficultyLevels);
        }

        if ($request->filled('max_time')) {
            $query->where('prep_time_minutes', '<=', $request->max_time);
        }

        // Ordenamiento
        $sort = $request->get('sort', 'title');
        $direction = $request->get('direction', 'asc');

        // Mapear campos de ordenamiento
        $sortField = match($sort) {
            'preparation_time' => 'prep_time_minutes',
            'created_at' => 'created_at',
            default => 'title'
        };

        $query->orderBy($sortField, $direction);

        $recipes = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();

        return view('recipes.index', compact('recipes', 'categories'));
    }

    public function show(Recipe $recipe)
    {
        // Verificar que la receta esté publicada
        if (!$recipe->is_published) {
            abort(404);
        }

        $recipe->load(['category', 'media', 'products', 'combos']);

        // Recetas relacionadas (misma categoría)
        $relatedRecipes = Recipe::where('category_id', $recipe->category_id)
            ->where('id', '!=', $recipe->id)
            ->where('is_published', true)
            ->with('media')
            ->limit(4)
            ->get();

        return view('recipes.show', compact('recipe', 'relatedRecipes'));
    }

    public function category(Category $category)
    {
        // Verificar que la categoría esté activa
        if (!$category->is_active) {
            abort(404);
        }

        $recipes = Recipe::where('category_id', $category->id)
            ->where('is_published', true)
            ->with(['category', 'media'])
            ->paginate(12);

        $categories = Category::where('is_active', true)->get();

        return view('recipes.category', compact('category', 'recipes', 'categories'));
    }

    public function addCombo(Recipe $recipe, Request $request)
    {
        // Verificar que la receta tenga combos
        if (!$recipe->combos()->exists()) {
            return back()->with('error', 'Esta receta no tiene un combo disponible.');
        }

        $combo = $recipe->combos()->first();

        // TODO: Implementar lógica completa del carrito
        // Por ahora solo mostramos un mensaje informativo
        return back()->with('info', "Funcionalidad de combos próximamente disponible. Combo '{$combo->title}' identificado.");
    }
}