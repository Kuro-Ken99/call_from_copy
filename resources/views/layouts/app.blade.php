<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        @include('layouts.header')
        <main>
            @yield('content')
        </main>
        @include('layouts.footer')
    </body>
</html>
