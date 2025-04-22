<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'min:2', 'max:12', 'alpha_num'],
            'email' => ['required', 'email', 'min:5', 'max:40', 'unique:users,email'],
            'password' => ['required', 'min:8', 'max:20', 'confirmed',],
            'password_confirmation' => ['required', 'string', 'alpha_num', 'min:8', 'max:20', 'same:password'],
            [ // ←こっちがカスタムエラーメッセージ
            'username.required' => 'ユーザー名は必須です。',
            'username.min' => 'ユーザー名は2文字以上必要です。',
            'username.max' => 'ユーザー名は12文字以内で入力してください。',
            'username.alpha_num' => 'ユーザー名は半角英数字のみです。',

            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '正しいメールアドレス形式で入力してください。',
            'email.min' => 'メールアドレスは5文字以上必要です。',
            'email.max' => 'メールアドレスは40文字以内で入力してください。',
            'email.unique' => 'このメールアドレスは既に登録されています。',

            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは8文字以上必要です。',
            'password.max' => 'パスワードは20文字以内で入力してください。',
            'password.confirmed' => 'パスワードが一致しません。',

            'password_confirmation.required' => 'パスワード確認は必須です。',
            'password_confirmation.alpha_num' => 'パスワード確認は半角英数字のみです。',
            'password_confirmation.same' => 'パスワード確認が一致しません。',
            ]
        ]);

        $randomIcon = 'icon' . rand(1, 7) . '.png';


        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'icon_image' => $randomIcon,
        ]);

        // ログイン後のリダイレクトなど
        Auth::login($user);

        $request->session()->put('key', $request->username);

        // auth()->login($user);

        return redirect('added');
        //  ->with('username');
    }

    public function added(): View
    {
        return view('auth.added');
    }

    public function logout(Request $request)
{
    $user = Auth::user();

    if ($user) {
        // ユーザー情報を確認
        \Log::info('Logged-in user:', ['user' => $user]);
    } else {
        \Log::info('No user is logged in.');
    }
    session()->flush();

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}
}
