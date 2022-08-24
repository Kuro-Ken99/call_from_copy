@extends('layouts.app')
@section('title', 'update')
@section('content')
<main>
    <div class="container">
        <div class="profile_update">
            <h1>プロフィール変更</h1>
            <form action="/update" method="POST">
                @csrf
                <label for="name">名前：</label>
                <input id="name" type="text" value="{{ Auth::user()->name }}" name="name" placeholder="名前" required>
                @error('name')
                    <small class="error">{{ $message }}</small>
                @enderror
                <label for="kana">ふりがな：</label>
                <input id="kana" type="text" value="{{ Auth::user()->kana }}" name="kana" placeholder="名前（かな）" required>
                @error('kana')
                    <small class="error">{{ $message }}</small>
                @enderror
                <label for="department">所属部署：</label>
                <input id="department" type="text" value="{{ Auth::user()->department }}" name="department" placeholder="所属部署">
                @error('department')
                    <small class="error">{{ $message }}</small>
                @enderror
                <label for="extension">内線番号：
                </label>
                <input id="extension" type="text" value="{{ Auth::user()->extension }}" name="extension" placeholder="内線番号">
                @error('extension')
                    <small class="error">{{ $message }}</small>
                @enderror
                <button type="submit">変更</button>
            </form>
        </div>
    </div>
</main>
@endsection
