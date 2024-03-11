<?php

namespace Database\Seeders;

use App\Models\Classifiers\Officer;
use Illuminate\Database\Seeder;

class OfficersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Officer::factory(20)->create();
    }
}
