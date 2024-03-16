<?php

namespace Database\Factories;

use App\Models\Accesses\User;
use App\Models\Classifiers\Officer;
use App\Models\Classifiers\Option;
use App\Models\Classifiers\Organization;
use App\Models\Classifiers\Registry;
use App\Models\Outgoing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Outgoing>
 */
class OutgoingFactory extends Factory
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
            'number' => $this->faker->numberBetween(1,1000),
            'date' => fake()->dateTimeThisYear(),
            'option_id' => Option::all()->random()->id,
            'organization_id' => Organization::all()->random()->id,
            'name' => fake()->word,
            'description' => fake()->text(),
            'page_count' => $this->faker->numberBetween(1, 10),
            'page_start' => $this->faker->numberBetween(1, 10),
            'confidential' => $confidential[$this->faker->numberBetween(0, 1)],// enum
            'exemplar_count' => $this->faker->numberBetween(1, 3),
            'image' => $this->faker->sentence,
            'registry_id' => Registry::all()->random()->id,
            'registry_part' => $this->faker->numberBetween(1, 3),
            'note' => fake()->sentence,
            'officer_id' => Officer::all()->random()->id,
            'created_who' => User::all()->random()->id,
            'updated_who' => User::all()->random()->id,
        ];
    }
}
