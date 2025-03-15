<x-login-layout>

<div class="follow-icons">
  <h3>フォロワーリスト</h3>
    <ul>
        @foreach ($followed as $user)
            @php
                $iconNumber = ($user->id % 7) + 1;
            @endphp

            <li style="display: inline-block; margin: 5px;">
              <a href="{{ route('profiles.profile', ['user' => $user->id]) }}">
                <img src="{{ asset('images/icon' . $iconNumber . '.png') }}" alt="{{ $user->username }}のアイコン" width="50"  style="border-radius: 50%;">
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
                @php
                $iconNumber = $post->user->id % 7 + 1;
                @endphp
                  <a href="{{ route('profiles.profile', ['user' => $post->user->id]) }}">
                    <img src="{{ asset('images/icon' . $iconNumber . '.png') }}" alt="ユーザーアイコン" width="50">
                  </a>
                <!-- {{-- ユーザー名 --}} -->
                <p>{{ $post->user->username }}</p>

                <!-- {{-- 投稿内容 --}} -->
                <p>{{ $post->post }}</p>

                <!-- {{-- 投稿日時 --}} -->
                <p>{{ $post->created_at->format('Y-m-d H:i') }}</p>

                <!-- {{-- 投稿ごとの仕切り線 --}} -->
                <hr style="border: 1px solid #ddd;">
            </div>
        @endforeach
      </div>

</x-login-layout>
