<?php

namespace Database\Factories\Classifiers;

use App\Models\Classifiers\Commander;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Commander>
 */
class CommanderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'short_name' => fake()->unique()->word,
        ];
    }
}
