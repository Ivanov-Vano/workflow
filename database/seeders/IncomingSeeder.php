<?php

namespace Database\Seeders;

use App\Models\Incoming;
use Illuminate\Database\Seeder;

class IncomingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Incoming::factory(50)->create();
    }
}
