@extends('layouts.app')

@section('title', '予約完了ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
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
    <div class="done">
        <div class="done__wrapper">
            <p class="done__message">ご予約ありがとうございます</p>
            <a class="done__back-link" href="{{ request('from') === 'mypage' ? route('show.mypage') : route('top.show') }}">戻る</a>
        </div>
    </div>
</main>
@endsection