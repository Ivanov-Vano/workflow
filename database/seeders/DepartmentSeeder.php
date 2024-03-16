<?php

namespace Database\Seeders;

use App\Models\Classifiers\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
         Department::factory(10)->create();
    }
}
