<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use App\Models\Comment;
use Auth;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    //コメント画面を表示
    public function commentShow(Blog $blog)
    {
        //dd($blog->comments->blog->user);

        return view('blog.comment', ['blog' => $blog]);
    }

    //コメントを追加
    public function commentStore(CommentRequest $request)
    {
        // 返信のデータを受け取る
        $inputs = $request->all();
        //dd($inputs);

        \DB::beginTransaction();
        try {
            // ブログを登録
            Comment::create($inputs);
            \DB::commit();
        } catch (\Throwable $e) {
            echo $e;
        }

        $url = 'blog/comments/' . (string)$request->blog_id;
        //dd($url);
        return redirect($url);
    }

    //コメントの削除機能
    public function commentDelete($id)
    {
        //dd($id);
        $comment = Comment::find($id);
        //コメントを削除
        $comment->delete();

        return redirect()->back();
    }
}
