<?php

namespace Database\Factories;

use App\Models\Classifiers\Organization;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;


class EventFactory extends Factory
{
    protected $model = Event::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = ['Совещание', 'Заседание'];

        return [
            'type' => $type[$this->faker->numberBetween(0, 1)],// enum
            'name' => $this->faker->word,
            'take_place_at' => $this->faker->dateTimeBetween('now', '+1 year'), // Генерация даты и времени
            'organization_id' => Organization::all()->random()->id,
            'place' => $this->faker->text,
            'participants_before_at' => $this->faker->dateTimeBetween('now', '+1 year'), // Генерация даты и времени
        ];
    }
}
