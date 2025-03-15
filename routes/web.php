<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FollowsController;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;
// use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

 Route::get('top', [PostsController::class, 'index'])->name('top');

 Route::get('profile', [ProfileController::class, 'profile']);

 Route::get('search', [UsersController::class, 'index'])->name('user.search');

 Route::get('follow-list', [PostsController::class, 'index']);
 Route::get('follower-list', [PostsController::class, 'index']);

 Route::get('/logout', [RegisteredUserController::class,'logout'])->name('logout');

 Route::get('/', function () {
    return redirect()->intended('top');
  });

  // フォロー機能
   Route::post('/following/{user}', [UsersController::class, 'following'])->name('following');
   Route::post('/followed/{user}', [UsersController::class, 'followed'])->name('followed');

  //  ユーザー検索
  Route::get('users.search', [UsersController::class, 'search'])->name('users.search');
  // 投稿
  Route::post('top', [PostsController::class, 'store'])->name('posts.store');
  // 投稿一覧を表示する処理
  Route::get('top', [PostsController::class, 'index'])->name('posts.index');

  Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');

  Route::put('top/{post}', [PostsController::class, 'update'])->name('posts.update');

  Route::delete('/top/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');

  // フォローリスト
  Route::get('/followList', [FollowsController::class, 'followList'])->name('follows.followList');

  Route::get('/followerList', [FollowsController::class, 'followerList'])->name('follows.followerList');

  Route::get('/followingPosts', [FollowsController::class, 'followingPosts'])->name('followingPosts');

// プロフィール
  Route::get('/profile/{user}', [ProfileController::class, 'profile'])->name('profiles.profile');

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // 自分のプロフィール編集ページ

  Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update'); // 自分のプロフィール更新
});
