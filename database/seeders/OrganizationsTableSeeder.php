<?php

namespace Database\Seeders;

use App\Models\Classifiers\Organization;
use Illuminate\Database\Seeder;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Organization::factory(10)->create();
    }
}
