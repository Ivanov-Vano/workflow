<?php

namespace Database\Factories\Classifiers;

use App\Models\Classifiers\Registry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Registry>
 */
class RegistryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->numberBetween(1, 100),
            'name' => fake()->word,
            'description' => fake()->text(),
            'year' => fake()->year,
            'order' => $this->faker->numberBetween(1, 100),
        ];
    }
}
