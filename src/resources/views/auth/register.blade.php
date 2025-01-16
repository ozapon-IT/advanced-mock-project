@extends('layouts.app')

@section('title', '会員登録ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
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
    <div class="register">
        <h1 class="register__title">Registration</h1>

        <form class="register__form" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="register__form-group">
                <i class="bi bi-person-fill"></i>

                <input class="register__input" type="text" name="name" value="{{ old('name') }}" placeholder="Username">

            </div>

            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror

            <div class="register__form-group">
                <i class="bi bi-envelope-fill"></i>

                <input class="register__input" type="text" name="email" value="{{ old('email') }}" placeholder="Email">

            </div>

            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror

            <div class="register__form-group">
                <i class="bi bi-lock-fill"></i>

                <input class="register__input" type="password" name="password" placeholder="Password">

            </div>

            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror

            <button class="register__button" type="submit">登録</button>
        </form>
    </div>
</main>
@endsection