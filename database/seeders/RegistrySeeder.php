<?php

namespace Database\Seeders;

use App\Models\Classifiers\Registry;
use Illuminate\Database\Seeder;

class RegistrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Registry::factory(20)->create();
    }
}
