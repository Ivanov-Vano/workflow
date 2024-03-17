<?php

namespace Database\Seeders;

use App\Models\Classifiers\Commander;
use Illuminate\Database\Seeder;

class CommanderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Commander::factory(20)->create();
    }
}
