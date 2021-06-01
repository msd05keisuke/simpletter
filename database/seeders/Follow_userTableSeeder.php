<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// 日付/時刻処理をするためにCarbonを追記する
use Carbon\Carbon;

class Follow_userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        //フォローに関する初期データ10個
        DB::table('follow_users')->insert([
            [
                'followed_user_id' => 1,
                'following_user_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'followed_user_id' => 2,
                'following_user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'followed_user_id' => 1,
                'following_user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'followed_user_id' => 3,
                'following_user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'followed_user_id' => 1,
                'following_user_id' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'followed_user_id' => 4,
                'following_user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'followed_user_id' => 1,
                'following_user_id' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'followed_user_id' => 5,
                'following_user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'followed_user_id' => 6,
                'following_user_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'followed_user_id' => 2,
                'following_user_id' => 7,
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
