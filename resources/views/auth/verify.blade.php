@extends('layouts.app')
@section('title', 'verify')
@section('content')
<div class="container">
    <div class="register_messages">
        @if (session('resent'))
            <p>本登録用メールを再送しました。</p>
        @endif
        <p>受信したメール内のリンクをクリックし、<br>登録を完了させてください。</p>
        <p>送信先：<span>{{ Auth::user()->email }}</span></p>
        <p>メールが届かなかった場合、<br>下記の「再送」ボタンを押してください。</p>
        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit">再送</button>
        </form>
        <p>入力したアドレスを誤った場合、<br>下記に正しいメールアドレスを入力の上、「送信」をクリックしてください。
        </p>
        <form action="/update_mail" method="POST">
            @csrf
            <input type="text" placeholder="新しいメールアドレス" name="email">
            <button type="submit">送信</button>
        </form>
        @error('email')
            <small class="error">{{ $message }}</small>
        @enderror
    </div>
</div>
@endsection
