<x-login-layout>

<div class="edit">

    <img
      src="{{ $user->icon_image
          ? (Str::startsWith($user->icon_image, 'icons/')
              ? asset('storage/' . $user->icon_image)
              : asset('images/' . $user->icon_image))
          : asset('images/icon.png') }}"
      alt="{{ $user->username }}のアイコン" class="user-icon">

      @if(session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif
    <div class="edit-form">
      <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
          @csrf
          @method('POST')

          <div class="form-group">
              <label for="username">ユーザー名</label>
              <div class="input-wrapper">
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username', Auth::user()->username) }}" required>
                @error('username')
                  <p class="error-message">{{ $message }}</p>
                @enderror
              </div>
          </div>

          <div class="form-group">
              <label for="email">メールアドレス</label>
              <div class="input-wrapper">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                @error('email')
                  <p class="error-message">{{ $message }}</p>
                @enderror
              </div>
          </div>

          <div class="form-group">
              <label for="password">パスワード</label>
              <div class="input-wrapper">
                <input type="password" class="form-control" id="password" name="password">
                @error('password')
                  <p class="error-message">{{ $message }}</p>
                @enderror
              </div>
          </div>

          <div class="form-group">
              <label for="password_confirmation">パスワード確認</label>
               <div class="input-wrapper">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                @error('password')
                  <p class="error-message">{{ $message }}</p>
                @enderror
              </div>
          </div>

          <div class="form-group">
              <label for="bio">自己紹介</label>
              <div class="input-wrapper">
                <input type="text" class="form-control" id="bio" name="bio" value="{{ old('bio', Auth::user()->bio) }}" required>
                @error('bio')
                  <p class="error-message">{{ $message }}</p>
                @enderror
              </div>
          </div>

          <div class="form-group">
            <label>アイコン画像</label>
            <label class="file-input">
              <span class="file-label-text">ファイルを選択</span>
              <input type="file" name="icon_image" accept="image/*">
            </label>
          </div>

          <div class="update-btn">
            <button type="submit" class="btn-primary">更新</button>
          </div>
      </form>
    </div>
</div>

</x-login-layout>
