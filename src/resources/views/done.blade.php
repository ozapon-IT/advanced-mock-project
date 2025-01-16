@extends('layouts.app')

@section('title', '予約完了ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
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
    <div class="done">
        <div class="done__content">
            <p class="done__message">ご予約ありがとうございます</p>
            <a class="done__back-button" href="{{ route('top.show') }}">戻る</a>
        </div>
    </div>
</main>
@endsection