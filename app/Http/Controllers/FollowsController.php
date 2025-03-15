<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    public function followList()
    {
        // 自分をフォローしているユーザーのID一覧を取得
        $followedIds = Auth::user()->following()->pluck('followed_id');

        // フォロワーの投稿を取得（新しい順）
        $posts = Post::whereIn('user_id', $followedIds)
            ->orderBy('created_at', 'desc')
            ->get();

        $followingUsers =User::whereIn('id', $followedIds)->select('id','icon_image')->get();

        return view('follows.followList', compact('posts', 'followingUsers'));
    }

    public function followerList()
    {
        // 自分をフォローしているユーザーのIDを取得（follower_idが自分のID）
        $followingIds = Auth::user()->followed()->pluck('following_id');

        // フォロワーの投稿を取得（新しい順）
        $posts = Post::whereIn('user_id', $followingIds)
            ->orderBy('created_at', 'desc')
            ->get();

        // 🔹 フォローしているユーザーの情報（アイコン含む）を取得
        $followed = User::whereIn('id', $followingIds)
            ->select('id', 'username', 'icon_image') // ユーザーのid、username、アイコン画像を取得
            ->get();

    return view('follows.followerList', compact('posts', 'followed'));
    }
}
