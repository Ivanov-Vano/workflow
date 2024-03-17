<?php

namespace Database\Seeders;

use App\Models\Classifiers\Node;
use App\Models\Classifiers\Tag;
use App\Models\Decree;
use App\Models\Disc;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DecreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nodes = Node::all()->random(3);
        $discs = Disc::all()->random(2);
        $tags = Tag::all()->random(1);
        Decree::factory(20)
            ->hasAttached($nodes, ['viewed_at' => Carbon::now()])
            ->hasAttached($tags)
            ->hasAttachments(3)
            ->create();
    }
}
