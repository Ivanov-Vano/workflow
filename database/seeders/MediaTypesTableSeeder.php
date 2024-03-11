<?php

namespace Database\Seeders;

use App\Models\Classifiers\MediaType;
use Illuminate\Database\Seeder;

class MediaTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = "database/data/media_types.json";
        $mediaTypes = json_decode(file_get_contents($path), true);
        foreach ($mediaTypes as $mediaType) {
            MediaType::updateOrCreate(['short_name' => $mediaType['short_name']],
                [
                    'short_name' => $mediaType['short_name'],
                ]
            );
        }
    }
}
