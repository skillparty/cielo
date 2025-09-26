<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(3, true);
        $basePrice = fake()->randomFloat(2, 15, 200);
        $hasPromo = fake()->boolean(30);
        
        return [
            'category_id' => Category::factory(),
            'sku' => fake()->unique()->regexify('[A-Z]{2}[0-9]{6}'),
            'slug' => fake()->unique()->slug(),
            'name' => ucwords($name),
            'subtitle' => fake()->optional()->sentence(6),
            'description' => fake()->optional()->paragraphs(2, true),
            'preparation_tips' => fake()->optional()->sentence(),
            'base_price' => $basePrice,
            'promo_price' => $hasPromo ? fake()->randomFloat(2, $basePrice * 0.7, $basePrice * 0.9) : null,
            'unit_type' => fake()->randomElement(['kg', 'gr', 'unidad', 'paquete']),
            'unit_quantity' => fake()->randomFloat(3, 0.1, 5),
            'stock' => fake()->randomFloat(3, 0, 100),
            'safety_stock' => fake()->randomFloat(3, 1, 10),
            'is_featured' => fake()->boolean(20),
            'is_active' => fake()->boolean(90),
            'nutrition_facts' => fake()->optional()->randomElements([
                'calories' => fake()->numberBetween(100, 500),
                'protein' => fake()->numberBetween(10, 50),
                'fat' => fake()->numberBetween(5, 30),
                'carbs' => fake()->numberBetween(0, 20),
            ]),
            'metadata' => fake()->optional()->randomElements([
                'origin' => fake()->city(),
                'storage' => fake()->sentence(),
            ]),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    public function withPromotion(): static
    {
        return $this->state(function (array $attributes) {
            $basePrice = $attributes['base_price'];
            return [
                'promo_price' => fake()->randomFloat(2, $basePrice * 0.7, $basePrice * 0.9),
            ];
        });
    }

    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => 0,
        ]);
    }
}
