<?php

namespace Database\Seeders;

use App\Models\Disc;
use Illuminate\Database\Seeder;

class DiscSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Disc::factory(50)->create();
    }
}
