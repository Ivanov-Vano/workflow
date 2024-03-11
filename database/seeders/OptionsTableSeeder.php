<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classifiers\Option;


class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = "database/data/options.json";
        $options = json_decode(file_get_contents($path), true);
        foreach ($options as $option) {
            Option::updateOrCreate(['short_name' => $option['short_name']],
                [
                    'short_name' => $option['short_name'],
                ]
            );
        }
    }
}
