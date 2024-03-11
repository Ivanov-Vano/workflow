<?php

namespace Database\Seeders;

use App\Models\Classifiers\Resolution;
use Illuminate\Database\Seeder;

class ResolutionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Resolution::factory(20)->create();
    }
}
