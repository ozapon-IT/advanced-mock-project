@extends('layouts.app')

@section('title', 'サンクスページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/thanks.css') }}">
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
    <div class="thanks">
        <div class="thanks__wrapper">
            <p class="thanks__message">会員登録ありがとうございます</p>
            <a class="thanks__button" href="/login">ログインする</a>
        </div>
    </div>
</main>
@endsection