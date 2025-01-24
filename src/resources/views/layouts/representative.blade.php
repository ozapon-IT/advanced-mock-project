<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/common/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common/representative.css') }}">
    @yield('css')
</head>

<body>
    @yield('header')

    @yield('main')

    @yield('script')

    <div class="modal-menu" id="modal-menu">
        <a href="#" class="modal-menu__close"><i class="bi bi-x"></i></a>

        <div class="modal-menu__content">
            <a class="modal-menu__link" href="{{ route('representative.dashboard') }}">Dashboard</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="modal-menu__button" type="submit">Logout</button>
            </form>
        </div>
    </div>
</body>

</html>