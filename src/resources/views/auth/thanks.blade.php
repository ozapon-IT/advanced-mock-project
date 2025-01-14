@extends('layouts.app')

@section('title', 'サンクスページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/thanks.css') }}">
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
    <div class="thanks">
        <div class="thanks__content">
            <p class="thanks__message">会員登録ありがとうございます</p>
            <a class="thanks__login-button" href="/login">ログインする</a>
        </div>
    </div>
</main>
@endsection