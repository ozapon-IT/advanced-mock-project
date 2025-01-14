@extends('layouts.app')

@section('title', 'ログインページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('header')
<header class="header">
    <div class="header__container">
        <div class="header__menu">
            <a class="menu__button" href="#modal-menu">
                <i class="bi bi-list"></i>
            </a>
            <h1 class="menu__service-name">Rese</h1>
        </div>
    </div>
</header>
@endsection

@section('main')
<main>
    <div class="login">
        <h1 class="login__title">Login</h1>

        <form class="login__form" action="">
            <div class="login__form-group">
                <i class="bi bi-envelope-fill"></i>

                <input class="login__input" type="text" name="email" value="{{ old('email') }}" placeholder="Email">
            </div>
            <div class="login__form-group">
                <i class="bi bi-lock-fill"></i>

                <input class="login__input" type="password" name="password" placeholder="Password">
            </div>

            <button class="login__button" type="submit">ログイン</button>
        </form>
    </div>
</main>
@endsection