<?php

namespace Database\Seeders;

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
        //userの初期データを１０件挿入する
        \App\Models\User::factory(10)->create();

        //そのほかの初期データを挿入する
        $this->call([
            BlogTableSeeder::class,
            LikeTableSeeder::class,
            Follow_userTableSeeder::class
        ]);


    }
}
