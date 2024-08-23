<?php

namespace Database\Seeders;

use App\Models\Classifiers\Node;
use App\Models\Classifiers\Tag;
use App\Models\Disc;
use App\Models\Incoming;
use App\Models\Outgoing;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OutgoingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Получаем входящие
        $incomings = Incoming::all();
        $nodes = Node::all()->random(3);
        $discs = Disc::all()->random(2);
        $tags = Tag::all()->random(1);
        Outgoing::factory(50)
            ->hasAttached($nodes, ['viewed_at' => Carbon::now()])
            ->hasAttached($discs)
            ->hasAttached($tags)
            ->hasAttachments(3)
        // фэйковые данные для модели Outgoing и связываем их с Incoming
            ->create()->each(function ($outgoing) use ($incomings) {
                // Связываем каждую запись Outgoing с двумя случайными записями Incoming
                $randomIncomings = $incomings->random(2);
                foreach ($randomIncomings as $incoming) {
                    $outgoing->incomings()->attach($incoming->id);
                }
            });;
    }
}
