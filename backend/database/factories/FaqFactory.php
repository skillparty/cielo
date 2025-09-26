<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category' => fake()->randomElement(['General', 'Pedidos', 'Pagos', 'Envíos', 'Productos']),
            'question' => fake()->sentence() . '?',
            'answer' => fake()->paragraphs(2, true),
            'display_order' => fake()->numberBetween(0, 100),
            'is_published' => fake()->boolean(90),
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
        ]);
    }

    public function forCategory($category): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => $category,
        ]);
    }
}
