<?php

namespace Database\Factories;

use App\Models\Classifiers\MediaType;
use App\Models\Classifiers\Registry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Disc>
 */
class DiscFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $confidental = ['СН', 'ДПС'];

        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->text(),
            'confidential' => $confidental[$this->faker->numberBetween(0, 1)],// enum
            'type_id' => MediaType::all()->random()->id,
            'registry_id' => Registry::all()->random()->id,
        ];
    }
}
