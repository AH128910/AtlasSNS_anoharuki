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

    // $request->validate([
    //     'username' => ['required', 'min:2', 'max:12', 'alpha_num'],
    //     'email' => ['required', 'email', 'min:5', 'max:40', 'unique:users,email'],
    //     'bio' => 'nullable|max:150',
    //     'NewPassword' => 'required|alpha_num|min:8|max:20|confirmed',
    //     'NewPasswordConfirmation' => 'required|alpha_num|min:8|max:20',
    //     'IconImage' => 'required|file|mimes:jpg,png,bmp,gif,svg|max:2048',
    // ]);

    // ユーザー情報の更新
    $user->username = $request->username;
    $user->bio = $request->bio;

    if ($request->filled('NewPassword')) {
        $user->password = bcrypt($request->NewPassword);
    }

    // アイコン画像のアップロード処理
    if ($request->hasFile('IconImage')) {
        $imagePath = $request->file('IconImage')->store('icons', 'public');
        $user->icon_image = 'storage/' . $imagePath;
    }

    $user->save();

    return redirect()->route('top');
    }
}
