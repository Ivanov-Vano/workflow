<?php

namespace Database\Seeders;

use App\Models\Classifiers\Resolution;
use Illuminate\Database\Seeder;

class ResolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Resolution::factory(20)->create();
    }
}
