<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\Disc;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RolesAndPermissionsSeeder::class,
            OrganizationsTableSeeder::class,
            RanksTableSeeder::class,
            OptionsTableSeeder::class,
            DepartmentSeeder::class,
            OfficersTableSeeder::class,
            CommandersTableSeeder::class,
            ResolutionsTableSeeder::class,
            RegistriesTableSeeder::class,
            NodesTableSeeder::class,
            MediaTypesTableSeeder::class,
            BookSeeder::class,
            DocumentSeeder::class,
            DiscSeeder::class,
            InventoriesTableSeeder::class,
            WorkbooksTableSeeder::class,
            IncomingSeeder::class,
            OutgoingSeeder::class,
        ]);
    }
}
