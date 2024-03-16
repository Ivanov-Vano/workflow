<?php

namespace Database\Factories\Classifiers;

use App\Models\Classifiers\MediaType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MediaType>
 */
class MediaTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'name_short' => fake()->unique()->word,
        ];
    }
}
