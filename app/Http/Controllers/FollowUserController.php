<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\FollowUser;
use Auth;

class FollowUserController extends Controller
{
    public function follow($id) {
        //自分をフォローしようとした場合にエラーを返す
        if (Auth::user()->id == $id) {
            abort(500);
        }
        $user = User::find($id);
        $user->followers()->attach(Auth::user()->id);
        $count = $user->followers()->count();
        $result = true;

        return response()->json(['count' => $count, 'result' => $result]);
    }

    public function unfollow($id) {
        $user = User::find($id);
        $user->followers()->detach(Auth::user()->id);
        $count = $user->followers()->count();
        $result = false;

        return response()->json(['count' => $count, 'result' => $result]);
    }

    public function countfollow ($id)
    {
        $user= User::find($id);
        $count = $user->followers()->count();
        return response()->json($count);
    }

    //ユーザーがアカウントをフォローしてるかしてないかの判定
    public function hasfollow($id)
    {
        $user = User::find($id);
        if ($user->followers()->where('followed_user_id', Auth::id())->exists()) {
            $result = true;
        } else {
            $result = false;
        }
        return response()->json($result);
    }

    //フォロワーページの表示
    public function showfollower($id)
    {
        $user = User::find($id);

        return view('follow.follower', ['user' => $user]);
    }

    //フォローページの表示
    public function showfollow($id)
    {
        $user = User::find($id);

        return view('follow.follow', ['user' => $user]);
    }
}
