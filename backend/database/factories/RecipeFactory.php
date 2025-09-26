<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->words(3, true);
        $isPublished = fake()->boolean(80);
        
        return [
            'category_id' => fake()->optional()->randomElement(Category::pluck('id')->toArray()),
            'slug' => fake()->unique()->slug(),
            'title' => ucwords($title),
            'subtitle' => fake()->optional()->sentence(6),
            'summary' => fake()->optional()->paragraph(),
            'instructions' => fake()->paragraphs(5, true),
            'prep_time_minutes' => fake()->numberBetween(5, 60),
            'cook_time_minutes' => fake()->numberBetween(10, 180),
            'difficulty_level' => fake()->numberBetween(1, 3),
            'servings' => fake()->numberBetween(1, 8),
            'video_url' => fake()->optional()->url(),
            'cover_image' => fake()->optional()->imageUrl(600, 400, 'food'),
            'nutrition_facts' => fake()->optional()->randomElements([
                'calories_per_serving' => fake()->numberBetween(200, 800),
                'protein' => fake()->numberBetween(15, 60),
                'fat' => fake()->numberBetween(5, 40),
                'carbs' => fake()->numberBetween(10, 80),
            ]),
            'metadata' => fake()->optional()->randomElements([
                'cuisine_type' => fake()->randomElement(['Boliviana', 'Internacional', 'Fusión']),
                'meal_type' => fake()->randomElement(['Desayuno', 'Almuerzo', 'Cena', 'Aperitivo']),
            ]),
            'is_published' => $isPublished,
            'published_at' => $isPublished ? fake()->dateTimeBetween('-1 year', 'now') : null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
            'published_at' => null,
        ]);
    }

    public function easy(): static
    {
        return $this->state(fn (array $attributes) => [
            'difficulty_level' => 1,
            'prep_time_minutes' => fake()->numberBetween(5, 20),
            'cook_time_minutes' => fake()->numberBetween(10, 30),
        ]);
    }

    public function difficult(): static
    {
        return $this->state(fn (array $attributes) => [
            'difficulty_level' => 3,
            'prep_time_minutes' => fake()->numberBetween(30, 60),
            'cook_time_minutes' => fake()->numberBetween(60, 180),
        ]);
    }
}
