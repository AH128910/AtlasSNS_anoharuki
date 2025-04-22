<x-login-layout>

  <div class="search-container">
    <form class="search-form" action="{{ route('users.search') }}" method="GET">
        <div class="input-with-button">
            <input type="text" name="keyword" class="search-input" placeholder="ユーザー名">
            <button type="submit" class="search-btn">
                <img src="{{ asset('images/search.png') }}" alt="検索ボタン">
            </button>
        </div>
    </form>

    @if(request('keyword'))
        <p class="search-keyword">検索ワード: <strong>{{ request('keyword') }}</strong></p>
    @endif
  </div>

<hr style="border: 5px solid #ddd; margin: 0;">




@if(isset($users) && $users->isNotEmpty())
  <ul class="user-list">
      @foreach ($users as $index => $user)
        <li class="user-item">
          <div class="user-row">
            @php
              $iconNumber = ($index % 7) + 1;
            @endphp

            <!-- アイコン -->
            <img src="{{ asset('images/' . $user->icon_image) }}" alt="{{ $user->username }}のアイコン" class="user-icon">


            <!-- ユーザー名 -->
            <p class="username">{{ $user->username }}</p>

            <!-- ボタン -->
            @if (Auth::user()->isFollowing($user->id))
              <form action="{{ route('followed', $user) }}" method="POST">
                @csrf
                <button type="submit" class="follow-btn">フォロー解除</button>
              </form>
            @else
              <form action="{{ route('following', $user) }}" method="POST">
                @csrf
                <button type="submit" class="following-btn">フォローする</button>
              </form>
            @endif
          </div>
        </li>
      @endforeach
  </ul>
@endif


</x-login-layout>
