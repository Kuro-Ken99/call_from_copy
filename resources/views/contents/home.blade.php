@extends('layouts.app')
@section('title', 'home')
@section('content')
<main>
    <div class="container">
        <div class="message_form">
            <h1>〇〇さん、お電話です！</h1>
            <form action="/send" method="POST">
                @csrf
                <label for="to_whom">誰さん宛？</label>
                <select id="to_whom" name="to_whom" required>
                    <option value="">宛先を選んでください</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{old('to_whom') == $user->id ? 'selected' : ''}}>{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('to_whom')
                    <small class="error">{{ $message }}</small>
                @enderror
                <label for="from_whom">誰からの電話？</label>
                <input id="from_whom" type="text" name="from_whom" value="{{ old('from_whom') }}" placeholder="例）〇〇株式会社　〇〇様" required>
                @error('from_whom')
                    <small class="error">{{ $message }}</small>
                @enderror
                <label for="business">用件は？</label>
                <textarea id="business" type="text" name="business" placeholder="例）請求書を再送してほしい、契約内容について確認したい、etc" required>{{ old('business') }}</textarea>
                @error('business')
                    <small class="error">{{ $message }}</small>
                @enderror
                <label for="correspondence">次の対応は？</label>
                <textarea id="correspondence" type="text" name="correspondence" placeholder="例）〇〇時までに折り返す、午後に再度先方から連絡予定、etc">{{ old('correspondence') }}</textarea>
                @error('correspondence')
                    <small class="error">{{ $message }}</small>
                @enderror
                <label for="phone_number">電話番号（折り返し用）</label>
                <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}">
                @error('phone_number')
                    <small class="error">{{ $message }}</small>
                @enderror
                <p>※宛先、入電元、用件は入力必須です</p>
                <button type="submit">お電話ありました！</button>
            </form>
            <p>{{ session('message') }}</p>
        </div>

        <div class="search">
            <h3>社員検索</h2>
            <form action="/search" method="POST">
                @csrf
                <input type="text" name="name">
                <button type="submit">検索</button>
                <p>※名前、ふりがな、所属部署での検索が可能です。</p>
            </form>
        </div>


        <div class="calls">
            <h2>自分宛の入電</h1>
            @foreach ($toMeList as $history)
            <div>
                <p>入電元： {{ $history->from_whom }}</p>
                <p>用件： {{ $history->business }}</p>
                <p>次の対応： {{ $history->correspondence }}</p>
                <p>折り返し先： {{ $history->phone_number }}</p>
                <p>取ってくれた人： {{ $history->user->name }}</p>
                <p>伝言日時： {{ $history->created_at }}</p>
                <form action="/delete/{{ $history->id }}" method="POST">
                    @csrf
                    <button type="submit">完了</button>
                </form>
            </div>
            @endforeach
        </div>
        <div class="calls">
            <h2>とってあげた入電</h2>
            @foreach ($byMeList as $history)
            <div>
                <p>宛先： {{ $history->user->name }}</p>
                <p>入電元： {{ $history->from_whom }}</p>
                <p>用件： {{ $history->business }}</p>
                <p>伝言日時： {{ $history->created_at }}</p>
                <form action="/delete_rough/{{ $history->id }}" method="POST">
                    @csrf
                    <button type="submit">削除</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
