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

.register-container {
  background: rgba(0, 0, 50, 0.2);
  padding: 25px;
  border-radius: 10px;
  text-align: center;
  width: 350px;
  color: white;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
}

h2 {
  font-size: 18px;
  margin-bottom: 20px;
  color: white;
}


/* ラベルのスタイル */
form label {
  display: block;
  text-align: left;
  font-weight: bold;
  margin-top: 20px;
  color: white;
}

/* 入力欄のスタイル */
.input {
  width: 100%;
  padding: 8px;
  margin-top: 0px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  color: black;
}


/* 送信ボタンのスタイル */
form input[type="submit"] {
  display: block;
  margin-top: 25px;
  margin-left: auto;  /* 右寄せ */
  padding: 5px 30px;
  background: #e74c3c;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
}

/* リンクのスタイル */
form p a {
  display: inline-block;
  margin-top: 15px;
  color: white;
  text-decoration: none;
  font-size: 14px;
}

form p a:hover {
  text-decoration: underline;
}
  </style>

<div class="register-container">
    {!! Form::open(['url' => 'register']) !!}

    <h2>新規ユーザー登録</h2>

    {{-- ユーザー名 --}}
    {{ Form::label('username', 'ユーザー名') }}
    {{ Form::text('username', null, ['class' => 'input']) }}
    @error('username')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    {{-- メールアドレス --}}
    {{ Form::label('email', 'メールアドレス') }}
    {{ Form::email('email', null, ['class' => 'input']) }}
    @error('email')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    {{-- パスワード --}}
    {{ Form::label('password', 'パスワード') }}
    {{ Form::password('password', ['class' => 'input']) }}
    @error('password')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    {{-- パスワード確認 --}}
    {{ Form::label('password_confirmation', 'パスワード確認') }}
    {{ Form::password('password_confirmation', ['class' => 'input']) }}
    @error('password_confirmation')
        <div class="text-danger">{{ $message }}</div>
    @enderror

    {{ Form::submit('新規登録') }}

    <p><a href="login">ログイン画面へ戻る</a></p>

    {!! Form::close() !!}
</div>


</x-logout-layout>
