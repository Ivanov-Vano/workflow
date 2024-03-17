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
            OrganizationSeeder::class,
            RankSeeder::class,
            OptionSeeder::class,
            TagSeeder::class,
            DepartmentSeeder::class,
            OfficerSeeder::class,
            CommanderSeeder::class,
            ResolutionSeeder::class,
            RegistrySeeder::class,
            NodeSeeder::class,
            MediaTypeSeeder::class,
            BookSeeder::class,
            DocumentSeeder::class,
            DiscSeeder::class,
            InventorySeeder::class,
            WorkbookSeeder::class,
            IncomingSeeder::class,
            OutgoingSeeder::class,
            DecreeSeeder::class,
        ]);
    }
}
