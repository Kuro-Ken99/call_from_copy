@extends('layouts.app')
@section('title', 'reset')
@section('content')
<div class="container">
    <div class="pass_reset">

        @if (session('status'))
            <p class="sent_announce">{{ session('status') }}</p>
        @endif

        <p>パスワードリセット用のリンクを送信します。</p>
        <p>ご登録のメールアドレスを下記フォームに入力し、<br>送信ボタンをクリックしてください。</p>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <label for="email">メールアドレス：</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            <button type="submit">送信</button>
        </form>
        @error('email')
                <small class="error">{{ $message }}</small>
        @enderror
    </div>
</div>
@endsection
