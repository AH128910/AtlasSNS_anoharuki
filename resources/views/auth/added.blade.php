<x-logout-layout>
  <div id="clear">
    <p>{{session()->get('key')}}さん</p>
    <p>ようこそ！AtlasSNSへ！</p>
    <p>ユーザー登録が完了しました。</p>
    <p>早速ログインをしてみましょう。</p>

    <p class="btn"><a href="login">ログイン画面へ</a></p>
  </div>
</x-logout-layout>
