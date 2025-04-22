<x-login-layout>

  <div class="profile-container">
        <!-- ユーザーアイコン -->
        <img src="{{ asset('images/' . $user->icon_image) }}" alt="{{ $user->username }}のアイコン" class="user-icon">

        <div class="profile-info">
          <div class="info-row">
            <p>ユーザー名</p> <!-- ユーザー名を表示 -->
            <p>{{ $user->username }}</p> <!-- ユーザー名を表示 -->
          </div>
          <!-- 自己紹介文 -->
          <div class="info-row">
            <p>自己紹介</p>
            <p>{{ $user->bio }}</p>
          </div>
        </div>

        <div class="profile-btn">
          @if (Auth::user()->isFollowing($user->id))
            <form action="{{ route('followed', $user->id) }}" method="POST">
            @csrf
              <button type="submit" class="follow-btn">フォロー解除</button>
            </form>
          @else
            <form action="{{ route('following', $user->id) }}" method="POST">
            @csrf
              <button type="submit" class="following-btn">フォローする</button>
            </form>
          @endif
        </div>
  </div>

  <hr style="border: 5px solid #ddd; margin: 0;">

  <div class="post-list">
    @if ($posts->isNotEmpty())
      @foreach ($posts as $post)
        <div class="post">

          <!-- ユーザーアイコン（クリックでプロフィールへ） -->
          <img src="{{ asset('images/' . $post->user->icon_image) }}" alt="{{ $post->user->username }}のアイコン" width="50" style="border-radius: 50%;">


          <div class="post-content">
            <p class="username">{{ $post->user->username }}</p>
            <p>{{ $post->post }}</p>
          </div>

          <!-- 投稿日時 -->
          <p class="timestamp">{{ $post->created_at->format('Y-m-d H:i') }}</p>

          <!-- {{-- 投稿ごとの仕切り線 --}} -->
          <hr style="border: 1px solid #ddd;">
        </div>
      @endforeach
        @else
        <p>投稿がありません。</p>
      @endif
  </div>

</x-login-layout>
