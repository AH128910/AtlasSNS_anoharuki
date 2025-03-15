<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
  public function index()
    {
      $users = User::get();

      return view('users.search',['users'=>$users]);
    }

    public function following(User $user){
        $authUser = Auth::user();

        if ($authUser->id !== $user->id) {
          $authUser->following()->attach($user->id); // フォローする
        }
        return back();
    }

    // followingの逆
    public function followed(User $user)
    {
        $authUser = Auth::user();

        if ($authUser->id !== $user->id) {
          $authUser->following()->detach($user->id); //3/7 followingからfollowedへ変更してる
        }
        return back();
    }

    public function search(Request $request)
    {
        $authUser = Auth::user(); // ログインユーザーを取得

        // ユーザー検索のクエリを作成（ログインユーザーを除外）
        $query = User::where('id', '!=', $authUser->id);

        // 検索キーワードを取得
        $keyword = $request->input('keyword');

        // キーワードが入力されていたら、部分一致検索を実行
        if (!empty($keyword)) {
            $query->where('username', 'LIKE', "%{$keyword}%");
        }

        // ユーザーリストを取得（10件ずつページネーション）
        $users = $query->paginate(10);

        // ビューへデータを渡す
        return view('users.search', ['users' => $users, 'keyword' => $keyword]);
    }
}
