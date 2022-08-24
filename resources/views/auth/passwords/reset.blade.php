@extends('layouts.app')
@section('title', 'reset')
@section('content')
<div class="container">
    <div class="pass_input">
        <p>新しいパスワードを下記フォームに入力し、<br>送信ボタンをクリックしてください。</p>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <label for="email">メールアドレス：</label>
            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <small class="error">{{ $message }}</small>
            @enderror
            <label for="password">パスワード：</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @error('password')
                <small class="error">{{ $message }}</small>
            @enderror
            <label for="password-confirm" >パスワード（再入力）：</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            <button type="submit">送信</button>
        </form>
    </div>
</div>
@endsection
