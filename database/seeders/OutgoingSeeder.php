<?php

namespace Database\Seeders;

use App\Models\Classifiers\Node;
use App\Models\Classifiers\Tag;
use App\Models\Disc;
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
        $nodes = Node::all()->random(3);
        $discs = Disc::all()->random(2);
        $tags = Tag::all()->random(1);
        Outgoing::factory(50)
            ->hasAttached($nodes, ['viewed_at' => Carbon::now()])
            ->hasAttached($discs)
            ->hasAttached($tags)
            ->hasAttachments(3)
            ->create();
    }
}
