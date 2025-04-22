<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;//登録ユーザーのDBを使用
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function profile(User $user)
    {

        $posts = Post::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

        return view('profiles.profile' ,compact('user', 'posts'));
    }

    public function get_user($user_id)
    {

        $user = User::with('following_id')->with('followed_id')->findOrFail($user_id);
        return response()->json($user);
    }

    public function edit()
    {
        $user = Auth::user(); // ログインユーザー情報
        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request)
    {
    $user = Auth::user();

    $request->validate([
        'username' => ['required', 'string', 'min:2', 'max:12'],
        'email' => ['required','string','email','min:5','max:40',
            Rule::unique('users', 'email')->ignore(auth()->id()),
        ],
        'password' => ['nullable', 'string', 'alpha_num', 'min:8', 'max:20'],
        'password_confirmation' => ['nullable', 'string', 'alpha_num', 'min:8', 'max:20', 'same:password'],
        'bio' => ['nullable', 'string', 'max:150'],
        'icon_image' => ['nullable', 'image', 'mimes:jpg,png,bmp,gif,svg'],
    ]);



        // ユーザー情報の更新
        $user->username = $request->username;
        $user->bio = $request->bio;

        // 新しいパスワードが入力された場合
    // パスワードが入力されている場合のみ更新
    if ($request->filled('password') && $request->password === $request->password_confirmation) {
        $user->password = bcrypt($request->password); // 新しいパスワードをハッシュ化して保存
    }

    // メールアドレスが更新された場合
    if ($request->filled('email') && $user->email !== $request->email) {
        $user->email = $request->email; // メールアドレスを更新
    }

    // アイコン画像のアップロード処理
    if ($request->hasFile('icon_image')) {
    $file = $request->file('icon_image');
    $filename = time() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('images'), $filename);
    $user->icon_image = $filename;
    $user->save();
}

        $user->save();

        return redirect()->route('posts.index');
        }
}
