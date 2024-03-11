<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number' => $this->faker->numberBetween(1,1000),
            'registered_at' => $this->faker->dateTimeBetween('6 days', '30 days'),
            'part' => $this->faker->numberBetween(1, 100),
            'note' => $this->faker->word,
            'description' => $this->faker->text(),
            'order' => $this->faker->numberBetween(1, 100),
        ];
    }
}
