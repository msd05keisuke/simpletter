<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;
use App\Models\User;
use App\Models\Blog;
use Auth;

class BlogController extends Controller
{
    //ブログ一覧を表示
    public function showList()
    {
        //　ページネーションで5個の投稿ごと表示
        $blogs = Blog::latest()->paginate(5);
        //dd($blogs);

        return view(
            'blog.blogs',
            [
                'blogs' => $blogs,
            ]
        );
    }

    //ブログ登録画面を表示
    public function showCreate()
    {
        return view('blog.form',);
    }

    //ブログを登録
    public function exeStore(BlogRequest $request)
    {

        // ブログのデータを受け取る
        $inputs = $request->all();
        $inputs = $inputs + array('user_id' => Auth::user()->id);
        //dd($inputs);

        \DB::beginTransaction();
        try {
            // ブログを登録
            Blog::create($inputs);
            \DB::commit();
        } catch (\Throwable $e) {
            abort(500);
        }

        \Session::flash('err_msg', 'ブログを投稿しました');
        return redirect(route('blogs'));
    }

    //ブログの削除
    public function exeDelete($id)
    {
        if (empty($id)) {
            abort(500);
        }

        $blog = Blog::find($id);

        //本人以外削除しようとした場合に404を返す
        if ($blog->user->id != Auth::user()->id) {
            abort(404);
        }

        try {
            //ブログについたコメントを削除
            $blog->comments()->delete();
            //ブログを削除
            $blog->delete();
        } catch (\Throwable $th) {
            abort(500);
        }

        return redirect()->back();
    }

    //ブログ編集画面を表示
    public function showEdit($id)
    {
        //dd($id);
        $blog = Blog::find($id);

        //ブログが存在しなかった場合
        if (is_null($blog)) {
            abort(404);
        }elseif ($blog->user->id != Auth::user()->id){
        //本人以外削除しようとした場合に404を返す
            abort(404);
        }

        return view(
            'blog.edit',
            ['blog' => $blog]
        );
    }

    /**
     * ブログを更新する
     *
     * @return view
     */
    public function exeUpdate(BlogRequest $request, Blog $blog)
    {
        // ブログのデータを受け取る
        $inputs = $request->all();
        //dd($inputs);

        \DB::beginTransaction();
        try {
            // ブログを更新
            $blog->fill([
                'content' => $inputs['content'],
            ]);
            //dd($blog);
            $blog->save();
            \DB::commit();
        } catch (\Throwable $e) {
            //echo $e;
            \DB::rollback();
            abort(500);
        }

        \Session::flash('err_msg', 'ブログを更新しました');
        
        return redirect('/');
    }

    //ブログの検索画面を表示
    public function showSearch(Request $request)
    {
        if ($request->search == '') {
            $blogs = Blog::latest()->paginate(5);
        }else {
            $query = Blog::query();
            $blogs = $query->where('content','like','%'.$request->search.'%')->latest()->paginate(5);
            //dd($blogs);
            \Session::flash('err_msg', '検索結果は'.$blogs->count().'件です');
        }

        return view(
            'blog.search',
            [
                'blogs' => $blogs
            ]

        );
    }
}
