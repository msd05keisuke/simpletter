<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Models\User;
use App\Models\Blog;
use Auth;

class FavoriteController extends Controller
{
    public function store($id)
    {
        $blog = Blog::find($id);
        $blog->users()->attach(Auth::id());
        $count = $blog->users()->count();
        $result = true;
        return response()->json([
            'result' => $result, 
            'count' => $count,  
        ]);
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->users()->detach(Auth::id());
        $count = $blog->users()->count();
        $result = false;
        return response()->json([
            'result' => $result, 
            'count' => $count,  
        ]);
    }

    public function count ($id)
    {
        $blog = Blog::find($id);
        $count = $blog->users()->count();
        return response()->json($count);
    }

    public function hasfavorite ($id)
    {
        $blog = Blog::find($id);
        if ($blog->users()->where('user_id', Auth::id())->exists()) {
            $result = true;
        } else {
            $result = false;
        }
        return response()->json($result);
    }

    public function userlikes ()
    {
        //現在ログインしているユーザーの情報を取得
        $user = Auth::user();

        return view('blog.likes', ['user' => $user]);

    }
}
