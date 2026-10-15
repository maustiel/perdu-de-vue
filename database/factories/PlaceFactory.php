<?php

namespace Database\Factories;

use App\Enums\PlaceKind;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Place>
 */
class PlaceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Quai '.fake()->numberBetween(1, 10),
            'kind' => fake()->randomElement(PlaceKind::cases()),
        ];
    }
}
