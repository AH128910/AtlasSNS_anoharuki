
        <div id="head">
            <h1><a href="{{ url('top') }}"><img src="{{ asset('images/atlas.png') }}" alt="Atlas" style="width: 100px; height: auto; "></a></h1>
            <!-- アコーディオン ↓-->
            <div id="menu">
                <div id="username">
                  <p class= "menu-trigger">{{ Auth::user()->username}}さん<p>
                </div>
                <div class = "menu-list">
                   <ul>
                      <li><a href="/top">ホーム</a></li>
                      <li><a href="/profile">プロフィール</a></li>
                      <li><a href="/logout">ログアウト</a></li>
                   </ul>
                </div>
            </div>
        </div>
