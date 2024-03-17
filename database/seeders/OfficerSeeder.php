<?php

namespace Database\Seeders;

use App\Models\Classifiers\Officer;
use Illuminate\Database\Seeder;

class OfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Officer::factory(20)->create();
    }
}
