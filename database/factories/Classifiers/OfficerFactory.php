<?php

namespace Database\Factories\Classifiers;

use App\Models\Classifiers\Department;
use App\Models\Classifiers\Officer;
use App\Models\Classifiers\Rank;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Officer>
 */
class OfficerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = ['мужской', 'женский'];
        $postfix = ['вна', 'вич'];

        return [
            'surname' => fake()->lastName,
            'name' => fake()->firstName,
            'patronymic' => fake()->firstNameMale.$postfix[fake()->numberBetween(0, 1)],
//            'full_name' => fake()->lastName.' '.fake()->firstName.' '.fake()->firstNameMale.$postfix[fake()->numberBetween(0, 1)],
            'birthdate' => $this->faker->dateTimeBetween('-14000  days', '-10000 days'),
            'gender' => $gender[$this->faker->numberBetween(0, 1)],// enum
            'sign_image' =>  $this->faker->text,
            'post' => $this->faker->jobTitle,
            'actual' => $this->faker->boolean(5),
            'personal_number' => $this->faker->phoneNumber,
            'rank_id' => Rank::all()->random()->id,
            'department_id' => Department::all()->random()->id,
        ];
    }
}
