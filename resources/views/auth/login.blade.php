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

.login-container {
  background: rgba(0, 0, 50, 0.2);
  padding: 30px;
  border-radius: 10px;
  text-align: center;
  width: 350px;
  color: white;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
}

.title {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 20px;
}

label {
  display: block;
  text-align: left;
  font-weight: bold;
  margin-bottom: 5px;
}


.input {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 12px;
  color: black;
}

input[type="password"] {
  color: black; /* ●の色を黒に */
}

.login-button {
  display: block;
  margin-left: auto;  /* 右寄せ */
  padding: 5px 20px;
  background: #e74c3c;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 12px;
  cursor: pointer;
  transition:0.3s;
}

.register-link {
  display: block;
  margin-top: 15px;
  color: white;
  text-decoration: none;
}

   </style>

<div class="login-container">
    <p class="title">AtlasSNSへようこそ</p>

  <!-- 適切なURLを入力してください -->
  {!! Form::open(['url' => 'login']) !!}

  {{ Form::label('メールアドレス') }}
  {{ Form::text('email',null,['class' => 'input']) }}
  {{ Form::label('パスワード') }}
  {{ Form::password('password',['class' => 'input']) }}

   {{ Form::submit('ログイン', ['class' => 'login-button']) }}

  <p><a href="register" class="register-link">新規ユーザーの方はこちら</a></p>

  {!! Form::close() !!}
</div>
</x-logout-layout>
