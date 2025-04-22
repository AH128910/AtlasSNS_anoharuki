<x-logout-layout>
  <style>

     body {
  margin: 0;
  padding: 0;
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background: linear-gradient(to bottom, #186AC9, #f8e831);
}
    #clear {
  background: rgba(0, 0, 50, 0.2);
  padding: 30px;
  border-radius: 10px;
  text-align: center;
  width: 350px;
  color: white;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
}
#clear p {
  font-size: 16px;
  color: white;
  margin-bottom: 10px;
}

#clear p:first-child {
  font-weight: bold;
  font-size: 16px;
  color: white;
}

/* ボタンのスタイル */
#clear .btn {
  margin-top: 20px;
}

#clear .btn a {
  display: block;
  margin-left: auto;  /* 右寄せ */
  padding: 10px 20px;
  background: #e74c3c;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
  transition: 0.6s;
}

form p a:hover {
  text-decoration: underline;
}
  </style>

  <div id="clear">
    <p>{{session()->get('key')}}さん</p>
    <p>ようこそ！AtlasSNSへ！</p>
    <p>ユーザー登録が完了しました。</p>
    <p>早速ログインをしてみましょう!</p>

    <p class="btn"><a href="login">ログイン画面へ</a></p>
  </div>
</x-logout-layout>
