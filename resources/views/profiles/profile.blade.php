<x-login-layout>

  <div class="profile-container">
    <p>ユーザー名 &nbsp; {{ $user->username }}</p> <!-- ユーザー名を表示 -->

    <!-- 自己紹介文 -->
    <p>自己紹介 &nbsp;  {{ $user->bio }}</p>

    <div class="profile-details">
        <!-- ユーザーアイコン -->
        <img src="{{ asset('images/icon' . ($user->id % 7 + 1) . '.png') }}" alt="{{ $user->username }}のアイコン" width="30" style="border-radius: 50%;">
    </div>
        @if (Auth::user()->isFollowing($user->id))
          <form action="{{ route('followed', $user->id) }}" method="POST">
          @csrf
            <button type="submit">フォロー解除</button>
          </form>
        @else
          <form action="{{ route('following', $user->id) }}" method="POST">
          @csrf
            <button type="submit">フォローする</button>
          </form>
        @endif
  </div>

  <hr style="border: 5px solid #ddd;">

  <div class="post-list">
    @if ($posts->isNotEmpty())
      @foreach ($posts as $post)
        <div class="post">
          @php
            $iconNumber = ($post->user->id % 7) + 1;
          @endphp

          <!-- ユーザーアイコン（クリックでプロフィールへ） -->
          <img src="{{ asset('images/icon' . ($user->id % 7 + 1) . '.png') }}" alt="{{ $user->username }}のアイコン" width="30" style="border-radius: 50%;">

          <!-- ユーザー名 -->
          <p>{{ $post->user->username }}</p>

          <!-- 投稿内容 -->
          <p>{{ $post->post }}</p>

          <!-- 投稿日時 -->
          <p>{{ $post->created_at->format('Y-m-d H:i') }}</p>

          <!-- {{-- 投稿ごとの仕切り線 --}} -->
          <hr style="border: 1px solid #ddd;">
        </div>
      @endforeach
    @else
      <p>投稿がありません。</p>
    @endif
  </div>







</x-login-layout>
