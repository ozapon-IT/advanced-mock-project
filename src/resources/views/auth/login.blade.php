@extends('layouts.user')

@section('title', 'ログインページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('header')
<x-header />
@endsection

@section('main')
<main>
    <div class="login">
        <h1 class="login__heading">Login</h1>

        <form class="login__form" action="{{ route('login') }}" method="POST">
            @csrf

            <div class="login__form-group">
                <i class="bi bi-envelope-fill"></i>

                <input class="login__input" type="text" name="email" value="{{ old('email') }}" placeholder="Email" autocomplete="email" aria-label="メールアドレスを入力してください">
            </div>

            <x-validation-error field="email" />

            <div class="login__form-group">
                <i class="bi bi-lock-fill"></i>

                <input class="login__input" type="password" name="password" placeholder="Password" autocomplete="current-password" aria-label="パスワードを入力してください">
            </div>

            <x-validation-error field="password" />

            <button class="login__button" type="submit">ログイン</button>
        </form>
    </div>
</main>
@endsection