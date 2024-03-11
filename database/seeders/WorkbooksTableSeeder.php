<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Workbook;
use App\Models\Classifiers\Officer;
use Carbon\Carbon;

class WorkbooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $officers = Officer::all();
        Workbook::factory(20)->create()->each(function ($workbook) use($officers)
        {
            $officers->each(function ($officer) use($workbook) {
                $workbook->officers()->attach($officer, ['received_at' => Carbon::today()->subDays(rand(0, 365))]);
            });
        });
    }
}
