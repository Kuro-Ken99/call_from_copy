<header>
    <div class="container">
        <div class="header_contents">
            <a href="/home" class="logo">call from</a>
            <nav>
                <ul>
                    @switch($_SERVER['REQUEST_URI'])
                        @case('/login')
                            <li><a href="/register">登録</a></li>
                            @break
                        @case('/register')
                            <li><a href="/login">login</a></li>
                            @break
                        @case('/home')
                            <li><a href="/mypage">mypage</a></li>
                            @break
                        @case('/search')
                        @case('/mypage')
                        @case('/update')
                            <li><a href="/home">top</a></li>
                            @break
                        @default
                    @endswitch
                    @if (Auth::user())
                        <li>
                            <form name="logout" method="POST" action="/logout">
                                @csrf
                                <button type="submit">logout</button>
                            </form>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</header>
