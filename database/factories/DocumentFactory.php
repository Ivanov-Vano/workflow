<?php

namespace Database\Factories;

use App\Models\Document;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $confidential = ['ns', 'dsp'];

        return [
            'name' => fake()->word,
            'description' => fake()->text(),
            'page_count' => fake()->numberBetween(1, 10),
            'confidential' => $confidential[$this->faker->numberBetween(0, 1)],// enum
            'exemplar_count' => $this->faker->numberBetween(1, 3),
            'date' => $this->faker->dateTimeThisYear(),
            'destroyed_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
