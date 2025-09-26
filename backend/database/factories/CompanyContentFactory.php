<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyContent>
 */
class CompanyContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sectionKey = fake()->randomElement(['hero', 'history', 'values', 'locations', 'certifications']);
        
        return [
            'section_key' => $sectionKey,
            'title' => fake()->sentence(3),
            'subtitle' => fake()->optional()->sentence(6),
            'content' => fake()->paragraphs(3, true),
            'gallery_images' => fake()->optional()->randomElements([
                fake()->imageUrl(800, 600, 'business'),
                fake()->imageUrl(800, 600, 'food'),
                fake()->imageUrl(800, 600, 'people'),
            ]),
            'video_url' => fake()->optional()->url(),
            'location_data' => $sectionKey === 'locations' ? [
                'latitude' => fake()->latitude(-22, -9), // Bolivia coordinates
                'longitude' => fake()->longitude(-69, -57),
                'address' => fake()->address(),
                'phone' => fake()->phoneNumber(),
                'hours' => 'Lun-Vie: 8:00-18:00, Sáb: 8:00-14:00',
            ] : null,
            'display_order' => fake()->numberBetween(0, 100),
            'is_published' => fake()->boolean(85),
            'metadata' => fake()->optional()->randomElements([
                'background_color' => fake()->hexColor(),
                'text_alignment' => fake()->randomElement(['left', 'center', 'right']),
            ]),
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
        ]);
    }

    public function forSection($sectionKey): static
    {
        return $this->state(fn (array $attributes) => [
            'section_key' => $sectionKey,
        ]);
    }

    public function withLocation(): static
    {
        return $this->state(fn (array $attributes) => [
            'location_data' => [
                'latitude' => fake()->latitude(-22, -9),
                'longitude' => fake()->longitude(-69, -57),
                'address' => fake()->address(),
                'phone' => fake()->phoneNumber(),
                'hours' => 'Lun-Vie: 8:00-18:00, Sáb: 8:00-14:00',
            ],
        ]);
    }
}
