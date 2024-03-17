<?php

namespace Database\Factories;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attachment>
 */
class AttachmentFactory extends Factory
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
            'page_count' => $this->faker->numberBetween(1, 10),
            'page_start' => $this->faker->numberBetween(1, 10),
            'confidential' => $confidential[$this->faker->numberBetween(0, 1)],// enum
            'image' => $this->faker->sentence,
        ];
    }
}
