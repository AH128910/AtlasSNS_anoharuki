<x-login-layout>

<div class="follower-content">
  <div class="follow-icons">
    <h3>フォロワーリスト</h3>
      <ul>
          @foreach ($followed as $user)
              <li style="display: inline-block; margin: 5px;">
                <a href="{{ route('profiles.profile', ['user' => $user->id]) }}">
                  <img src="{{ asset('images/' . $user->icon_image) }}" alt="{{ $user->username }}のアイコン" width="50" class="user-icon">
                </a>
              </li>
          @endforeach
      </ul>
  </div>

  <hr style="border: 5px solid #ddd;">

<!-- {{-- フォロワーの投稿表示 --}} -->
  <div class="post-list">
    @foreach ($posts as $post)
      <div class="post">
      <!-- {{-- ユーザーアイコン --}} -->
        <a href="{{ route('profiles.profile', ['user' => $post->user->id]) }}">
          <img src="{{ asset('images/' . $user->icon_image) }}" alt="{{ $user->username }}のアイコン" class="user-icon">
        </a>
        <!-- {{-- ユーザー名 --}} -->
        <div class="post-content">
          <p class="username">{{ $post->user->username }}</p>
          <p>{{ $post->post }}</p>
        </div>

        <!-- {{-- 投稿日時 --}} -->
        <p class="timestamp">{{ $post->created_at->format('Y-m-d H:i') }}</p>

        <!-- {{-- 投稿ごとの仕切り線 --}} -->
        <hr style="border: 1px solid #ddd;">
      </div>
    @endforeach
  </div>
</div>

</x-login-layout>
