@extends('layouts.app')
@section('title', 'search')
@section('content')
<main>
    <div class="container">
        <div class="result">
            <h1>名前で検索</h1>
            <form action="/search" method="POST">
                @csrf
                <input type="text" name="name">
                <button type="submit">検索</button>
            </form>
            @if($results->isNotEmpty())
                <table border="3">
                    <tr>
                        <th>名前</th>
                        <th>ふりがな</th>
                        <th>部署</th>
                        <th>内線番号</th>
                    </tr>
                    @foreach ($results as $result)
                        <tr>
                            <td>{{ $result->name }}</td>
                            <td>{{ $result->kana }}</td>
                            <td>{{ $result->department }}</td>
                            <td>{{ $result->extension }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
            @if($results->isEmpty())
                <p class="error">検索結果がありませんでした。<br>条件を変えて、再度お試しください。</p>
            @endif
        </div>
    </div>
</main>
@endsection
