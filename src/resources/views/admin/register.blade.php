@extends('layouts.admin')

@section('title', '店舗代表者登録画面 - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/register.css') }}">
@endsection

@section('header')
<header class="header">
    <div class="header__wrapper">
        <div class="header__menu">
            <a class="header__menu-toggle" href="#modal-menu">
                <i class="bi bi-list"></i>
            </a>
            <span class="header__service-name">Rese</span>
        </div>
    </div>
</header>
@endsection

@section('main')
<main>
    <div class="register">
        <h1 class="register__heading">Registration</h1>

        <form class="register__form" action="{{ route('create.representative') }}" method="POST">
            @csrf

            <div class="register__form-group">
                <i class="bi bi-person-fill"></i>

                <input class="register__input" type="text" name="name" value="{{ old('name') }}" placeholder="Username" aria-label="ユーザー名を入力してください">
            </div>

            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror

            <div class="register__form-group">
                <i class="bi bi-envelope-fill"></i>

                <input class="register__input" type="text" name="email" value="{{ old('email') }}" placeholder="Email" aria-label="メールアドレスを入力してください">
            </div>

            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror

            <div class="register__form-group">
                <i class="bi bi-lock-fill"></i>

                <input class="register__input" type="password" name="password" placeholder="Password" aria-label="パスワードを入力してください">
            </div>

            @error('password')
                <span class="error-message">{{ $message }}</span>
            @enderror

            <button class="register__button" type="submit">登録</button>
        </form>
    </div>
</main>
@endsection