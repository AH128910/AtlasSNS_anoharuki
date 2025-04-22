
        <div id="header">
            <h1><a href="{{ url('top') }}"><img src="{{ asset('images/atlas.png') }}" alt="Atlas" class="header-logo"></a></h1>
            <!-- アコーディオン ↓-->
            <div id="menu">
                <div id="username">
                    <span class="user-name">{{ Auth::user()->username }}</span>
                    <span class="user-suffix">さん</span>
                    <span class="menu-trigger"></span> <!-- ← 矢印だけのトリガー -->

                    <div class = "menu-list">
                    <ul>
                        <li><a href="/top">ホーム</a></li>
                        <li><a href="/profile">プロフィール</a></li>
                        <li><a href="/logout">ログアウト</a></li>
                    </ul>
                    </div>
                    @php
                    $iconNumber = Auth::user()->id % 7 + 1;
                    @endphp
                    <img src="{{ asset('images/' . Auth::user()->icon_image) }}" alt="ユーザーアイコン" class="user-icon">
                </div>

            </div>
        </div>
