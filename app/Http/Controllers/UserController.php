<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Image;

class UserController extends Controller
{
    //ユーザーのプロフィールを表示
    public function profile($user_id){
        $user = User::find($user_id);
        //dd($user->followers()->where('followed_user_id', Auth::id())->exists());
        if (is_null($user)) {
            abort(404);
        }      
        
        return view('profile', ['user' => $user]);
    }

    //プロフィール更新画面の表示
    public function profileEdit($user_id){
        $user = User::find($user_id);
        
        if (is_null($user) || Auth::user()->id != $user->id) {
            abort(404);
        }      
        
        return view('profileEdit', ['user' => $user]);
    }

    //プロフィール画像の更新
    public function update_avatar(Request $request, $user_id){
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' .$avatar->getClientOriginalExtension();
            Image::make($avatar)->fit(200, 200)->save( public_path('uploads/avatars/'. $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        if($request->name != Auth::user()->name) {
            $user = Auth::user();
            $user->name = $request->name;
            $user->save();
        }

        $user = User::find($user_id);
        if (is_null($user)) {
            return redirect(route('blogs'));
        }
        return view('profileEdit', ['user' => $user]);
    }
}
