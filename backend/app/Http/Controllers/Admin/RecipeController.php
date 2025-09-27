<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::with(['category', 'media']);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty_level', $request->difficulty);
        }

        $recipes = $query->paginate(15);
        $categories = Category::all();

        return view('admin.recipes.index', compact('recipes', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.recipes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|json',
            'instructions' => 'required|json',
            'prep_time' => 'required|integer|min:1',
            'cook_time' => 'required|integer|min:1',
            'servings' => 'required|integer|min:1',
            'difficulty_level' => 'required|in:easy,medium,hard',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $recipe = Recipe::create($request->except(['images']));

        // Manejar la subida de imágenes
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $recipe->addMediaFromRequest('images')
                    ->each(function ($fileAdder) {
                        $fileAdder->toMediaCollection('images');
                    });
            }
        }

        return redirect()->route('admin.recipes.index')
            ->with('success', 'Receta creada exitosamente.');
    }

    public function show(Recipe $recipe)
    {
        $recipe->load(['category', 'media']);
        return view('admin.recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        $categories = Category::all();
        return view('admin.recipes.edit', compact('recipe', 'categories'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|json',
            'instructions' => 'required|json',
            'prep_time' => 'required|integer|min:1',
            'cook_time' => 'required|integer|min:1',
            'servings' => 'required|integer|min:1',
            'difficulty_level' => 'required|in:easy,medium,hard',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $recipe->update($request->except(['images']));

        // Manejar la subida de nuevas imágenes
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $recipe->addMediaFromRequest('images')
                    ->each(function ($fileAdder) {
                        $fileAdder->toMediaCollection('images');
                    });
            }
        }

        return redirect()->route('admin.recipes.index')
            ->with('success', 'Receta actualizada exitosamente.');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('admin.recipes.index')
            ->with('success', 'Receta eliminada exitosamente.');
    }
}