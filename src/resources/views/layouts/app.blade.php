<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('css/common/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/base.css') }}">
    @yield('css')
</head>

<body>
    @yield('header')

    @yield('main')

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>

    @yield('script')

    <div class="modal-menu" id="modal-menu">
        <a href="#" class="modal-menu__close"><i class="bi bi-x"></i></a>

        <div class="modal-menu__content">
            @guest
                <a class="modal-menu__link" href="{{ route('top.show') }}">Home</a>
                <a class="modal-menu__link" href="{{ route('register') }}">Registration</a>
                <a class="modal-menu__link" href="{{ route('login') }}">Login</a>
            @endguest

            @auth
                <a class="modal-menu__link" href="{{ route('top.show') }}">Home</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button class="modal-menu__button" type="submit">Logout</button>
                </form>
                <a class="modal-menu__link" href="{{ route('mypage.show') }}">Mypage</a>
            @endauth
        </div>
    </div>
</body>

</html>