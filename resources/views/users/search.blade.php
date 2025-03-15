<x-login-layout>

<form action="{{ route('users.search') }}" method="GET">
    <input type="text" name="keyword" class="form" placeholder="ユーザー名">
    <button type="submit" style="border: none; background: none; padding: 0; cursor: pointer;">
        <img src="{{ asset('images/search.png') }}" alt="検索ボタン" width="30">
    </button>
</form>

@if(request('keyword'))
  <p>検索ワード: <strong>{{ request('keyword') }}</strong></p>
@endif

@php
  $icons = [
    'images/icon1.png',
    'images/icon2.png',
    'images/icon3.png',
    'images/icon4.png',
    'images/icon5.png',
    'images/icon6.png',
    'images/icon7.png'
  ];
@endphp


@if(isset($users) && $users->isNotEmpty())

  <ul>
      @foreach ($users as $index => $user)
        <li>
          <div>
            @php
              $iconNumber = ($index % 7) + 1;
            @endphp

            <!-- ユーザーアイコン -->
            <img src="{{ asset('images/icon' . $iconNumber . '.png') }}" alt="{{ $user->username }}のアイコン" width="50">

            <!-- ユーザー名 -->
            <p>{{ $user->username }}</p>

            <!-- フォロー/フォロー解除ボタン -->
            @if (Auth::user()->isFollowing($user->id))
              <form action="{{ route('followed', $user) }}" method="POST">
                @csrf
                <button type="submit">フォロー解除</button>
              </form>
            @else
              <form action="{{ route('following', $user) }}" method="POST">
                @csrf
                <button type="submit">フォローする</button>
              </form>
            @endif
          </div>
        </li>
      @endforeach
  </ul>
@endif

</x-login-layout>
