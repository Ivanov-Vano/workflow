<?php

namespace Database\Factories;

use App\Models\Accesses\User;
use App\Models\Classifiers\Officer;
use App\Models\Classifiers\Option;
use App\Models\Classifiers\Organization;
use App\Models\Classifiers\Registry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incoming>
 */
class IncomingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $confidental = ['ns', 'dsp'];
        $importance = ['vies-ma-srochno', 'vybrat-datu', 'obychnaia', 'opierativno', 'srochno'];

        return [
            'number' => $this->faker->numberBetween(1,1000),
            'date' => fake()->dateTimeThisYear(),
            'name' => fake('ru_RU')->word,
            'sender_number' => '2023/00'.$this->faker->numberBetween(10,99),
            'sender_date' => $this->faker->dateTimeThisYear(),
            'sender_name' => fake()->name(),
            'sender_phone' => $this->faker->phoneNumber,
            'organization_id' => Organization::all()->random()->id,
            'option_id' => Option::all()->random()->id,
            'description' => fake()->text(),
            'page_count' => $this->faker->numberBetween(1, 10),
            'page_start' => $this->faker->numberBetween(1, 10),
            'confidential' => $confidental[$this->faker->numberBetween(0, 1)],// enum
            'exemplar_count' => $this->faker->numberBetween(1, 3),
            'image' => $this->faker->sentence,
            'registry_id' => Registry::all()->random()->id,
            'resolution' => fake()->sentence,
            'deadline' => $this->faker->dateTimeBetween('6 days', '30 days'),
            'completed_at' => $this->faker->dateTimeThisYear(),
            'officer_id' => Officer::all()->random()->id,
            'is_complete' => $this->faker->boolean,
            'registry_part' => $this->faker->numberBetween(1, 3),
            'importance' => $importance[$this->faker->numberBetween(0, 4)],// enum
            'result_text' => fake()->sentence,
            'whose_resolution' => Officer::all()->random()->id,
            'created_who' => User::all()->random()->id,
            'updated_who' => User::all()->random()->id,
            'sign_completed_who' => User::all()->random()->id,
            'sign_completed_at' => $this->faker->dateTimeThisYear(),
            'is_internal' => $this->faker->boolean,
        ];
    }
}
