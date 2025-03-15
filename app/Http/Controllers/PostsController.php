<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PostsController extends Controller
{
    public function store(Request $request)
    {
    $request->validate([
        'post' => 'required|string|min:1|max:150'
    ]);
    // デバック
    // dd($request->all());

    Post::create([
        'user_id' => Auth::id(),
        'post' => $request->post
    ]);


    return redirect()->route('posts.store')->with('success', '投稿しました！');
    }

    // 投稿一覧を表示する処理
    public function index()
    {
    $authUser = Auth::user();

    $followedIds = Auth::user()->following()->pluck('followed_id');

    // 自分の投稿 & フォローしているユーザーの投稿のみ取得
    $posts = Post::whereIn('user_id', $followedIds)
            ->orWhere('user_id', $authUser->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $followingUsers =User::whereIn('id', $followedIds)->select('id','icon_image')->get();

    return view('posts.index', compact('posts'));
    }

    // 編集
    public function edit(Post $post)
    {
    // 投稿者以外の編集を防ぐ
    if ($post->user_id !== Auth::id()) {
        return redirect()->route('posts.index')->with('error', '権限がありません');
    }

    return view('posts.index', compact('posts'));
    }

    public function update(Request $request, Post $post)
    {
    // 投稿者以外の編集を防ぐ
    if ($post->user_id !== Auth::id()) {
        return redirect()->route('posts.index')->with('error', '権限がありません');
    }

    $request->validate([
        'post' => 'required|string|min:1|max:150',
    ]);

    $post->update([
        'post' => $request->post,
    ]);

    return redirect()->route('posts.index')->with('success', '投稿を更新しました！');
    }

    public function destroy(Post $post)
    {
    // 投稿者以外の削除を防ぐ
    if ($post->user_id !== Auth::id()) {
        return redirect()->route('posts.index')->with('error', '権限がありません');
    }

    $post->delete();

    return redirect()->route('posts.index')->with('success', '投稿を削除しました！');
    }
}
