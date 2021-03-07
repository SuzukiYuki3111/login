<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Place Register System</title>
</head>
<body>
    <!-- header -->
    <header>
        @guest
            <!-- ログインしてないとここが表示されます。 -->
            <a href="{{ route('login') }}">ログイン</a>
            <a href="{{ route('register') }}">会員登録</a>
        @endguest

        @auth
            <!-- ログインしている場合にはここも表示されます。 -->
            名前: {{ Auth::user()->name }}
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
        @endauth
    </header>

    @yield('contents')

    <!-- footer -->
    <footer></footer>
</body>
</html>
