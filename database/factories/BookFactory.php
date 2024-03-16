<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => $this->faker->numberBetween(1,1000),
            'registered_at' => $this->faker->dateTimeBetween('6 days', '30 days'),
            'part' => $this->faker->numberBetween(1, 100),
            'note' => fake()->word,
            'description' => fake()->text(),
            'order' => $this->faker->numberBetween(1, 100),
        ];
    }
}
