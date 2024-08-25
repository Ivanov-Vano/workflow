<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Incoming;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получаем входящие
        $incomings = Incoming::all();

        // Создаем фэйковые данные для модели Event и связываем их с Incoming
        Event::factory(10)->create()->each(function ($event) use ($incomings) {
            // Связываем каждую запись Event с двумя случайными записями Incoming
            $randomIncomings = $incomings->random(2);
            foreach ($randomIncomings as $incoming) {
                $event->incomings()->attach($incoming->id);
            }
        });
    }
}
