<?php

namespace Database\Factories\Classifiers;

use App\Models\Classifiers\Department;
use App\Models\Classifiers\Rank;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OfficerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = ['мужской', 'женский'];
        $postfix = ['вна', 'вич'];

        return [
            'surname' => $this->faker->lastName,
            'name' => $this->faker->firstName,
            'patronymic' => $this->faker->firstNameMale.$postfix[$this->faker->numberBetween(0, 1)],
            'full_name' => $this->faker->lastName.' '.$this->faker->firstName.' '.$this->faker->firstNameMale.$postfix[$this->faker->numberBetween(0, 1)],
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
