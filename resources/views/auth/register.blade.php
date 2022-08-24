@extends('layouts.app')
@section('title', 'register')
@section('content')
<main>
    <div class="container">
        <div class="user_form">
            <h1>ユーザー登録</h1>
            <form action="/register" method="POST">
                @csrf
                <label for="name">名前：</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <small class="error">{{ $message }}</small>
                @enderror
                <label for="kana">名前（ふりがな）：</label>
                <input id="kana" type="text" name="kana" value="{{ old('kana') }}" required>
                @error('kana')
                    <small class="error">{{ $message }}</small>
                @enderror
                <label for="email">メールアドレス：</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <small class="error">{{ $message }}</small>
                @enderror
                <label for="password">パスワード：</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <small class="error">{{ $message }}</small>
                @enderror
                <label for="password_confirmation">パスワード（再入力）：</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
                @error('password_confirmation')
                    <small class="error">{{ $message }}</small>
                @enderror
                <label for="department">所属部署：</label>
                <input id="department" type="text" name="department" value="{{ old('department') }}">
                @error('department')
                    <small class="error">{{ $message }}</small>
                @enderror
                <label for="extension">内線番号：</label>
                <input id="extension" type="text" name="extension" value="{{ old('extension') }}">
                @error('extension')
                    <small class="error">{{ $message }}</small>
                @enderror
                <button type="submit">登録</button>
                <p>※名前、ふりがな、メールアドレス、パスワードは必須です。</p>
                <p>ふりがなはスペースを開けずに入力してください。</p>
            </form>
        </div>
    </div>
</main>
@endsection
