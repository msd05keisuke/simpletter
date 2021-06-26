<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();


//プロフィールの表示
Route::get('/profile/{user}', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
//プロフィール更新画面の表示
Route::get('/profile/{user}/edit', [App\Http\Controllers\UserController::class, 'profileEdit'])->middleware('auth')->name('profileedit');
//プロフィールの更新
Route::post('/profile/{user}/edit', [App\Http\Controllers\UserController::class, 'update_avatar'])->middleware('auth')->name('update.avatar');


//ブログ一覧を表示
Route::get('/', [App\Http\Controllers\BlogController::class, 'showList'])->name('blogs');
//ブログの新規投稿画面の表示
Route::get('/blog/new', [App\Http\Controllers\BlogController::class, 'showCreate'])->middleware('auth')->name('new');
//ブログの新規投稿
Route::post('/blog/new/create', [App\Http\Controllers\BlogController::class, 'exeStore'])->middleware('auth')->name('new.blog');
//ブログの削除
Route::post('/blog/delete/{blog}', [App\Http\Controllers\BlogController::class, 'exeDelete'])->middleware('auth')->name('delete');
//ブログの編集画面を表示
Route::get('/blog/edit/{blog}', [App\Http\Controllers\BlogController::class, 'showEdit'])->middleware('auth')->name('edit');
//ブログの更新
Route::post('/blog/update/{blog}', [App\Http\Controllers\BlogController::class, 'exeUpdate'])->middleware('auth')->name('update');
//ブログの検索
Route::get('/blog/search', [App\Http\Controllers\BlogController::class, 'showSearch'])->name('search');



//いいねをする 
Route::post('/blog/favorite/{blog}', [App\Http\Controllers\FavoriteController::class, 'store'])->middleware('auth')->name('favorite');
//いいねを解除
Route::post('/blog/unfavorite/{blog}', [App\Http\Controllers\FavoriteController::class, 'destroy'])->middleware('auth')->name('unfavorite');
//いいねカウント
Route::get('/blog/countfavorite/{blog}', [App\Http\Controllers\FavoriteController::class, 'count'])->middleware('auth')->name('count');
//いいね結果判定
Route::get('/blog/hasfavorite/{blog}', [App\Http\Controllers\FavoriteController::class, 'hasfavorite'])->middleware('auth')->name('hasfavorite');
//いいねした投稿を表示
Route::get('/blog/likes/{user}', [App\Http\Controllers\FavoriteController::class, 'userlikes'])->middleware('auth')->name('likes');

//コメント画面を表示
Route::get('/blog/comments/{blog}', [App\Http\Controllers\CommentController::class, 'commentShow'])->middleware('auth')->name('comment');
//コメントの追加
Route::post('/blog/comments/{blog}/create', [App\Http\Controllers\CommentController::class, 'commentStore'])->middleware('auth')->name('commentstore');
//コメントを削除
Route::post('/blog/comments/{blog}', [App\Http\Controllers\CommentController::class, 'commentDelete'])->middleware('auth')->name('commentdelete');

//フォロー
Route::post('/profile/follow/{user}', [App\Http\Controllers\FollowUserController::class, 'follow'])->middleware('auth')->name('follow');
//フォロー解除
Route::post('/profile/unfollow/{user}', [App\Http\Controllers\FollowUserController::class, 'unfollow'])->middleware('auth')->name('unfollow');
//カウント
Route::get('/profile/countfollow/{user}', [App\Http\Controllers\FollowUserController::class, 'countfollow'])->middleware('auth')->name('countfollow');
//結果判定
Route::get('/profile/hasfollow/{user}', [App\Http\Controllers\FollowUserController::class, 'hasfollow'])->middleware('auth')->name('hasfollow');
//フォロワー　一覧ページの表示
Route::get('/profile/{user}/follower', [App\Http\Controllers\FollowUserController::class, 'showfollower'])->name('showfollower');
//フォロー　一覧ページの表示
Route::get('/profile/{user}/follow', [App\Http\Controllers\FollowUserController::class, 'showfollow'])->name('showfollow');;
