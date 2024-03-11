<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Classifiers\Officer;
use App\Models\Classifiers\Registry;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $confidental = ['ns', 'dsp'];

        return [
            'name' => $this->faker->word,
            'description' => $this->faker->text(),
            'page_count' => $this->faker->numberBetween(1, 10),
            'confidential' => $confidental[$this->faker->numberBetween(0, 1)],// enum
            'exemplar_count' => $this->faker->numberBetween(1, 3),
            'date' => $this->faker->dateTimeThisYear(),
            'destroyed_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
