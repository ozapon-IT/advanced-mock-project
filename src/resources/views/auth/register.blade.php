@extends('layouts.user')

@section('title', '会員登録ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('header')
<x-header />
@endsection

@section('main')
<main>
    <div class="register">
        <h1 class="register__heading">Registration</h1>

        <form class="register__form" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="register__form-group">
                <i class="bi bi-person-fill"></i>

                <input class="register__input" type="text" name="name" value="{{ old('name') }}" placeholder="Username" aria-label="ユーザー名を入力してください">
            </div>

            <x-validation-error field="name" />

            <div class="register__form-group">
                <i class="bi bi-envelope-fill"></i>

                <input class="register__input" type="text" name="email" value="{{ old('email') }}" placeholder="Email" aria-label="メールアドレスを入力してください">
            </div>

            <x-validation-error field="email" />

            <div class="register__form-group">
                <i class="bi bi-lock-fill"></i>

                <input class="register__input" type="password" name="password" placeholder="Password" autocomplete="new-password" aria-label="パスワードを入力してください">
            </div>

            <x-validation-error field="password" />

            <button class="register__button" type="submit">登録</button>
        </form>
    </div>
</main>
@endsection