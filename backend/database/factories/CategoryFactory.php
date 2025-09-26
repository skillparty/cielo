<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(2, true);
        
        return [
            'slug' => fake()->unique()->slug(),
            'name' => ucwords($name),
            'description' => fake()->optional()->sentence(),
            'display_order' => fake()->numberBetween(0, 100),
            'is_active' => fake()->boolean(85),
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    public function withParent($parentId): static
    {
        return $this->state(fn (array $attributes) => [
            'parent_id' => $parentId,
        ]);
    }
}
