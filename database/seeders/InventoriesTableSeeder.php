<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventory;
use App\Models\Classifiers\Officer;
use Carbon\Carbon;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $officers = Officer::all();
        Inventory::factory(20)->create()->each(function ($inventory) use($officers)
        {
            $officers->each(function ($officer) use($inventory) {
                $inventory->officers()->attach($officer, ['received_at' => Carbon::today()->subDays(rand(0, 365))]);
            });
        });
    }
}
