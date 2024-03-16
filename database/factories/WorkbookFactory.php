<?php

namespace Database\Factories;

use App\Models\Workbook;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;

/**
 * @extends Factory<Workbook>
 */
class WorkbookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $confidential = ['НС', 'ДСП'];

        return [
            'number' => $this->faker->word,
            'registered_at' => $this->faker->dateTimeBetween('6 days', '30 days'),
            'name' => fake()->word,
            'page_count' => $this->faker->numberBetween(1, 10),
            'confidential' => $confidential[$this->faker->numberBetween(0, 1)],// enum
            'destroyed_at' => $this->faker->dateTimeBetween('6 days', '30 days'),
            'book_id' => Book::all()->random()->id,
        ];
    }
}
