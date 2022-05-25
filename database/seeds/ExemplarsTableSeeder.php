<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExemplarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 20; $i++)
            DB::table('exemplars')->insert([
                'num' => $i,
                'note' => str_random(10),
                'indoc_id' => random_int(1,10),
            ]);
    }
}
