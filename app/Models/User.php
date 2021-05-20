<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\FollowUser;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * id->user_id
     * ユーザ-が投稿したブログを取得
     * 
     */
    public function blogs()
    {
        return $this->hasMany('App\Models\Blog', 'user_id');
    }

    /**
     * 多対多
     * ユーザーがしたいいねの投稿の一覧を取得
     */
    public function favorites()
    {
        return $this->belongsToMany('App\Models\Blog', 'likes')->withTimestamps();
    }


    //フォロー関連
    //このユーザがフォローしている人を取得
    public function followings()
    {
        return $this->belongsToMany('App\Models\User', 'follow_users', 'followed_user_id', 'following_user_id')->withTimestamps();
    }

    //このユーザをフォローしている人を取得
    public function followers()
    {
        return $this->belongsToMany('App\Models\User', 'follow_users', 'following_user_id', 'followed_user_id')->withTimestamps();
    }
}
