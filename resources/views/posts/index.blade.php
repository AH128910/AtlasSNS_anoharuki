<x-login-layout>

  <form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <!-- {{ Auth::id() }} -->
    <div class="post-form">
        {{-- ログインユーザーのアイコンを表示 --}}
        <img
            src="{{ Auth::user()->icon_image
                ? (Str::startsWith(Auth::user()->icon_image, 'icons/')
                    ? asset('storage/' . Auth::user()->icon_image)
                    : asset('images/' . Auth::user()->icon_image))
                : asset('images/icon.png') }}"
            alt="ユーザーアイコン"
            class="user-icon"
            width="50">


        {{-- テキストエリア＋エラー表示のラッパー --}}
        <div class="textarea-wrapper">
            <textarea type="text" name="post" placeholder="投稿内容を入力してください" required></textarea>
            @error('post')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" style="border: none; background: none; padding: 0; cursor: pointer;">
          <img src="{{ asset('images/post.png') }}" alt="投稿ボタン" width="40">
        </button>
    </form>

        <!-- 非表示のフォーム -->
  <form id="post-form" action="{{ route('posts.store') }}" method="POST" style="display: none;">
    @csrf
      <input type="hidden" name="post" id="hidden-post">
  </form>
    </div>
  </form>

  <hr style="border: 5px solid #ddd; margin: 0;">

  @foreach ($posts as $post)
    <div class="post">
        {{-- ユーザー情報 --}}

        <img
            src="{{ $post->user->icon_image
                ? (Str::startsWith($post->user->icon_image, 'icons/')
                    ? asset('storage/' . $post->user->icon_image)
                    : asset('images/' . $post->user->icon_image))
                : asset('images/icon.png') }}"
            alt="ユーザーアイコン"
            width="50" class="user-icon">

        <div class="post-content">
          <p class="username">{{ $post->user->username }}</p>
          <p>{{ $post->post }}</p>
        </div>
        <p class="timestamp">{{ $post->created_at->format('Y-m-d H:i') }}</p>

        {{-- ログイン中のユーザーの投稿なら編集・削除ボタンを表示 --}}
        @if ($post->user_id === Auth::id())
            <div class="post-actions">
                {{-- 編集ボタン --}}
                <a href="#" onclick="event.preventDefault(); openModal({{ $post->id }}, '{{ $post->post }}');">
                    <img src="{{ asset('images/edit.png') }}" alt="編集" width="30">
                </a>

                {{-- 削除フォーム --}}
                <form id="delete-form-{{ $post->id }}" action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

                {{-- 削除ボタン --}}
                <a href="#" onclick="event.preventDefault(); deletePost({{ $post->id }});">
                  <img src="{{ asset('images/trash.png') }}" alt="削除" width="30"
                  onmouseover="this.src='{{ asset('images/trash-h.png') }}'"
                  onmouseout="this.src='{{ asset('images/trash.png') }}'">
                </a>
            </div>
        @endif

        {{-- ✅ 各投稿の区切り線（編集・削除ボタン含む場合と分ける） --}}
        <hr style="border: 1px solid #ddd;">

        {{-- ✅ モーダル（投稿編集） --}}
        <div id="editModal{{ $post->id }}" class="modal" style="display: none;">
            <div class="modal-content">
                <form action="{{ route('posts.update', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <textarea name="post" rows="3">{{ old('post', $post->post) }}</textarea>
                    <button type="submit" class="update-button">
                      <img src="{{ asset('images/edit.png') }}" alt="更新">
                    </button>
                </form>
            </div>
        </div>
    </div>
@endforeach


    {{-- モーダル用JavaScript --}}
    <script>
        function openModal(postId) {
            document.getElementById('editModal' + postId).style.display = 'block';
        }

        function closeModal(postId) {
            document.getElementById('editModal' + postId).style.display = 'none';
        }
    </script>

    <script>
        function deletePost(postId) {
            if (confirm('この投稿を削除します。よろしいでしょうか？')) {
                document.getElementById('delete-form-' + postId).submit();
            }
        }
    </script>

    <script>
    function submitPost() {
        document.getElementById('post-form').submit();
    }
</script>



</x-login-layout>
