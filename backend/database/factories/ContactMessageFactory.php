<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactMessage>
 */
class ContactMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['new', 'in_progress', 'resolved', 'closed']);
        $isResolved = in_array($status, ['resolved', 'closed']);
        
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->numerify('+591########'),
            'subject' => fake()->sentence(4),
            'message' => fake()->paragraphs(2, true),
            'status' => $status,
            'admin_notes' => fake()->optional()->sentence(),
            'assigned_to' => fake()->optional()->randomElement(User::pluck('id')->toArray()),
            'resolved_at' => $isResolved ? fake()->dateTimeBetween('-1 month', 'now') : null,
            'metadata' => fake()->optional()->randomElements([
                'source' => fake()->randomElement(['web', 'phone', 'email']),
                'priority' => fake()->randomElement(['low', 'medium', 'high']),
            ]),
        ];
    }

    public function new(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'new',
            'assigned_to' => null,
            'resolved_at' => null,
        ]);
    }

    public function resolved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'resolved',
            'resolved_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ]);
    }

    public function assignedTo($userId): static
    {
        return $this->state(fn (array $attributes) => [
            'assigned_to' => $userId,
            'status' => 'in_progress',
        ]);
    }
}
