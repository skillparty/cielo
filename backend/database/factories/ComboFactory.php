<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Combo>
 */
class ComboFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(2, true);
        $price = fake()->randomFloat(2, 50, 300);
        $hasComparePrice = fake()->boolean(40);
        
        return [
            'recipe_id' => fake()->optional()->randomElement(Recipe::pluck('id')->toArray()),
            'slug' => fake()->unique()->slug(),
            'name' => 'Combo ' . ucwords($name),
            'subtitle' => fake()->optional()->sentence(6),
            'description' => fake()->optional()->paragraph(),
            'price' => $price,
            'compare_at_price' => $hasComparePrice ? fake()->randomFloat(2, $price * 1.1, $price * 1.5) : null,
            'is_active' => fake()->boolean(85),
            'is_default_recipe_combo' => fake()->boolean(30),
            'display_order' => fake()->numberBetween(0, 100),
            'metadata' => fake()->optional()->randomElements([
                'promotion_type' => fake()->randomElement(['descuento', 'especial', 'temporada']),
                'valid_until' => fake()->optional()->dateTimeBetween('now', '+3 months'),
            ]),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    public function defaultForRecipe(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_default_recipe_combo' => true,
        ]);
    }

    public function withDiscount(): static
    {
        return $this->state(function (array $attributes) {
            $price = $attributes['price'];
            return [
                'compare_at_price' => fake()->randomFloat(2, $price * 1.2, $price * 1.6),
            ];
        });
    }

    public function forRecipe($recipeId): static
    {
        return $this->state(fn (array $attributes) => [
            'recipe_id' => $recipeId,
        ]);
    }
}
