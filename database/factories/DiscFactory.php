<?php

namespace Database\Factories;

use App\Models\Classifiers\MediaType;
use App\Models\Classifiers\Registry;
use App\Models\Disc;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Disc>
 */
class DiscFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $confidental = ['ns', 'dsp'];

        return [
            'name' => fake()->word(),
            'description' => fake()->text(),
            'confidential' => $confidental[fake()->numberBetween(0, 1)],// enum
            'type_id' => MediaType::all()->random()->id,
            'registry_id' => Registry::all()->random()->id,
        ];
    }
}
