<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// 日付/時刻処理をするためにCarbonを追記する
use Carbon\Carbon;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        //ブログ内容に関する初期データ
        DB::table('blogs')->insert([
            [
                'content' => 'シンプルすぎー',
                'user_id' => '1',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'content' => 'さわやかおいしいいいいいいい',
                'user_id' => '3',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'content' => 'よろしくお願いします！',
                'user_id' => '5',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'content' => '初心者です！',
                'user_id' => '7',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'content' => '釣り好きの人ーーーー！',
                'user_id' => '9',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'content' => 'ひますぎーーーーー',
                'user_id' => '2',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'content' => 'あ、わい口がくさすぎた',
                'user_id' => '3',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
