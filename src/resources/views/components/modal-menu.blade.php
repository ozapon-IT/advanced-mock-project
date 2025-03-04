<div class="modal-menu" id="modal-menu">
    <div class="modal-menu__header">
        <div class="modal-menu__close-container">
            <a href="#" class="modal-menu__close"><i class="bi bi-x"></i></a>
        </div>
    </div>

    <div class="modal-menu__content">
        @if ($role === 'guest')
            <a class="modal-menu__link" href="{{ route('index') }}">Home</a>

            <a class="modal-menu__link" href="{{ route('register') }}">Registration</a>

            <a class="modal-menu__link" href="{{ route('login') }}">Login</a>
        @elseif ($role === 'user')
            <a class="modal-menu__link" href="{{ route('index') }}">Home</a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="modal-menu__button" type="submit">Logout</button>
            </form>

            <a class="modal-menu__link" href="{{ route('mypage.index') }}">Mypage</a>
        @elseif ($role === 'admin')
            <a class="modal-menu__link" href="{{ route('index') }}">Home</a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="modal-menu__button" type="submit">Logout</button>
            </form>

            <a class="modal-menu__link" href="{{ route('admin.dashboard') }}">Dashboard</a>
        @elseif ($role === 'representative')
            <a class="modal-menu__link" href="{{ route('index') }}">Home</a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="modal-menu__button" type="submit">Logout</button>
            </form>

            <a class="modal-menu__link" href="{{ route('representative.dashboard') }}">Dashboard</a>
        @endif
    </div>
</div>