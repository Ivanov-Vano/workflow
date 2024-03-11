<?php

namespace Database\Seeders;

use App\Models\Classifiers\Node;
use Illuminate\Database\Seeder;

class NodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Node::factory(20)->create();
    }
}
