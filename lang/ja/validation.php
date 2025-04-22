<?php

return [

    // 標準メッセージ（必要な分だけ残してOK）
    'required' => ':attribute は必須です。',
    'email' => ':attribute は正しいメールアドレス形式で入力してください。',
    'min' => [
        'string' => ':attribute は :min 文字以上で入力してください。',
    ],
    'max' => [
        'string' => ':attribute は :max 文字以内で入力してください。',
    ],
    'alpha_num' => ':attribute は半角英数字のみです。',
    'confirmed' => ':attribute が一致しません。',
    'same' => ':attribute が一致しません。',

    // 🔽 ここがカスタム属性名（日本語で表示したい）
    'attributes' => [
        'username' => 'ユーザー名',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード確認',
        'post' => '投稿内容',
        'bio' => '自己紹介',
    ],
];
