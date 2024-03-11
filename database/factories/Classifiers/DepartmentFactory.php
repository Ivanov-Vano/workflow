<?php

namespace Database\Factories\Classifiers;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classifiers\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),
            'name_short' => $this->faker->unique()->word,
            'sort' => $this->faker->numberBetween(1,50),
            'actual' =>$this->faker->boolean(2),
        ];
    }
}
