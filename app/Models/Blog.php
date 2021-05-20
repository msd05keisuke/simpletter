<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    //　テーブル名
  protected $table = 'blogs';

  // 可変項目
  protected $fillable =
  [
    'content',
    'user_id'
  ];

  /**
   * 
   * 
   */
  public function user()
  {
    // 第一引数元のつなぎ合わせたいもののカラム名 第二引数つなぎ合わせたいもののカラム名

    return $this->belongsTo('App\Models\User', 'user_id', 'id');
  }

  /**
   * 多対多
   * ブログにいいねしたユーザーの情報を取得
   * 
   */
  public function users()
  {
    return $this->belongsToMany('App\Models\User', 'likes')->withTimestamps();
  }

  /**
   * コメント　一対多
   * 
   */
  public function comments()
  {
    return $this->hasMany('App\Models\Comment', 'blog_id');
  }
}
