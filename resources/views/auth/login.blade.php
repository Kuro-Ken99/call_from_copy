@extends('layouts.app')
@section('title', 'login')
@section('content')
<main>
    <div class="container">
        <div class="user_form">
            <h1>login</h1>
            <form action="/login" method="POST">
                @csrf
                <label for="email">email：</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <small class="error">{{ $message }}</small>
                @enderror
                <label for="password">password：</label>
                <input id="password" type="password" name="password" value="{{ old('password') }}" required>
                @error('password')
                    <small class="error">{{ $message }}</small>
                @enderror
                <button type="submit">login</button>
            </form>
            <a href="/password/reset">パスワードを忘れた場合</a>
        </div>
    </div>
</main>
@endsection
