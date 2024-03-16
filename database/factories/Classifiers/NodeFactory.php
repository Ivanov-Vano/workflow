<?php

namespace Database\Factories\Classifiers;

use App\Models\Classifiers\Node;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Node>
 */
class NodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'name_short' => fake()->unique()->word,
            'sort' => $this->faker->numberBetween(1,50),
            'actual' =>$this->faker->boolean(2),
        ];
    }
}
