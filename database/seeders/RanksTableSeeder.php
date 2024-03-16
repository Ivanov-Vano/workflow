<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classifiers\Rank;


class RanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $path = "database/data/ranks.json";
        $ranks = json_decode(file_get_contents($path), true);
        foreach ($ranks as $rank) {
            Rank::updateOrCreate(['short_name' => $rank['short_name']],
                [
                    'short_name' => $rank['short_name'],
                ]
            );
        }
    }
}
