<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndocsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 11; $i++)
            DB::table('indocs')->insert([
                'num' => rand(1,1500),
                'date' => date("Y-m-d H:i:s"),
                'outnum' => '224/'.$i.Str::random(10),
                'outdate' => date("Y-m-d H:i:s"),
                'sender' => 'отправитель',
                'text' => 'Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне.',
                'media' => 'носитель'
            ]);
    }
}
