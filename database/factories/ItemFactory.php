<?php

namespace Database\Factories;

use App\Enums\Color;
use App\Models\Item;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    public function definition(): array
    {
        $foundOn = fake()->dateTimeBetween('2026-10-01', '2026-10-15');

        return [
            'place_id' => Place::factory(),
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'color' => fake()->randomElement(Color::cases()),
            'found_on' => $foundOn->format('Y-m-d'),
            'returned_at' => null,
        ];
    }

    public function returned(): static
    {
        return $this->state(fn (array $attributes) => [
            'returned_at' => fake()->dateTimeBetween($attributes['found_on'] ?? '2026-10-01', '2026-10-15')->format('Y-m-d'),
        ]);
    }
}
