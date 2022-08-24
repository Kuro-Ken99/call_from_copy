@extends('layouts.app')
@section('title', 'mypage')
@section('content')
<main>
    <div class="container">
        <div class="profile">
            <h1>プロフィール</h1>
            <p>名前：{{ Auth::user()->name }}</p>
            <p>名前（かな）：{{ Auth::user()->kana }}</p>
            <p>所属部署：{{ Auth::user()->department }}</p>
            <p>内線番号：{{ Auth::user()->extension }}</p>
            <a href="/update">変更画面へ</a>
            <small class="update_complete">{{ session('message') }}</small>
            <p>メールアドレス：{{ Auth::user()->email }}</p>
            <form action="/update_mail" method="POST">
                @csrf
                <input type="email" placeholder="新しいメールアドレス" name="email">
                <button type="submit">変更</button>
            </form>
            @error('email')
                <small class="error">{{ $message }}</small>
            @enderror
            <p>パスワード：非表示</p>
            <a href="/password/reset">変更画面へ</a>
        </div>
        <div class="account_delete">
            <h2>アカウント削除</h2>
            <form action="/delete" method="POST">
                @csrf
                <input type="password" name="password" placeholder="パスワードを入力" required>
                <button type="submit">削除</button>
            </form>
            <small>※削除する場合は所属する組織の方針に従ってください。</small>
            <small class="error">{{ session('wrong_pass') }}</small>
        </div>
    </div>
</main>
@endsection
