<?php

namespace Database\Factories;

use App\Models\Accesses\User;
use App\Models\Classifiers\Commander;
use App\Models\Decree;
use App\Models\Incoming;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Decree>
 */
class DecreeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $confidential = ['ns', 'dsp'];
        $type = ['Приказ', 'Приказание'];

        return [
            'number' => $this->faker->numberBetween(1,1000),
            'date' => fake()->dateTimeThisYear(),
            'type' => $type[$this->faker->numberBetween(0, 1)],// enum
            'name' => fake()->word,
            'description' => fake()->text(),
            'image' => $this->faker->sentence,
            'incoming_id' => Incoming::all()->random()->id,
            'confidential' => $confidential[$this->faker->numberBetween(0, 1)],// enum
            'exemplar_count' => $this->faker->numberBetween(1, 3),
            'page_count' => $this->faker->numberBetween(1, 10),
            'page_start' => $this->faker->numberBetween(1, 10),
            'commander_id' => Commander::all()->random()->id,
            'created_who' => User::all()->random()->id,
            'updated_who' => User::all()->random()->id,
            'sign_who' => User::all()->random()->id,
        ];
    }
}
