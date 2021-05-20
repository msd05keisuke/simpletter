<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //　テーブル名
    protected $table = 'comments';

    // 可変項目
    protected $fillable =
    [
        'content',
        'user_id',
        'blog_id'
    ];


    //コメントからブログを取得
    public function blog()
    {
        return $this->belongsTo('App\Models\Blog',);
    }



    //コメントしたユーザーの情報を取得 多対一
    public function user()
    {
        // 第一引数は元(comments)のつなぎ合わせたいもののカラム名 第二引数つなぎ合わせたいもの(users)のカラム名

        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
