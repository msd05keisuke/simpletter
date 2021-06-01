<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// 日付/時刻処理をするためにCarbonを追記する
use Carbon\Carbon;

class LikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        //いいねに関する初期データ10個
        DB::table('likes')->insert([
            [
                'user_id' => 1,
                'blog_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 2,
                'blog_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 3,
                'blog_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 2,
                'blog_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 4,
                'blog_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 6,
                'blog_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 9,
                'blog_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 2,
                'blog_id' => 7,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 3,
                'blog_id' => 6,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'user_id' => 6,
                'blog_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ]
            
        ]);
    }
}
