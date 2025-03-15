<x-login-layout>

<div class="container">

      <img src="{{ asset('images/icon' . ($user->id % 7 + 1) . '.png') }}" alt="{{ $user->username }}のアイコン" width="50" style="border-radius: 50%;">

      @if(session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="username">ユーザー名</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', Auth::user()->username) }}" required>
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" class="form-control" id="password" name="NewPassword">
        </div>

        <div class="form-group">
            <label for="password_confirmation">パスワード確認</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <div class="form-group">
            <label for="bio">自己紹介</label>
            <input type="bio" class="form-control" id="bio" name="bio" value="{{ old('bio', Auth::user()->bio) }}" required>
        </div>

        <div class="form-group">
            <label>アイコン画像</label>
        <input type="file" name="icon_image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>

</x-login-layout>
