<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //    factory(App\Organization::class, 50)->create()->each(function ($u) {
    //        $u->posts()->save(factory(App\Organization::class)->make());
    //    });

        $this->call([
            IndocsTableSeeder::class,
            ExemplarsTableSeeder::class,
        ]);
    }
}
