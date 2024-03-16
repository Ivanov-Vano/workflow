<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Document;

/**
 * @extends Factory<Inventory>
 */
class InventoryFactory extends Factory
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
            'date' => $this->faker->dateTimeBetween('6 days', '30 days'),
            'book_id' => Book::all()->random()->id,
            'document_id' => Document::all()->random()->id,
        ];
    }
}
