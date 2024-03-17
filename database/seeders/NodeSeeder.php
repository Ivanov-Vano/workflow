<?php

namespace Database\Seeders;

use App\Models\Classifiers\Node;
use Illuminate\Database\Seeder;

class NodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Node::factory(20)->create();
    }
}
