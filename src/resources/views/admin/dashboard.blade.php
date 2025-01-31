@extends('layouts.admin')

@section('title', 'ダッシュボード(管理者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
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
    <div class="dashboard">
        <h2 class="dashboard__title">Dashboard</h2>
        @if ($errors->has('error'))
            <div class="message message--alert">
                <span>{{ $errors->first('error') }}</span>
            </div>
        @elseif (session('success'))
            <div class="message">
                <span>{{ session('success') }}</span>
            </div>
        @endif
        <div class="dashboard__contents">
            <div class="contents__user">
                <h3 class="user__title">ユーザー</h3>
                <div class="user__announce">
                    <p>総ユーザー数: {{ $totalUsers }}人</p>
                    <a href="{{ route('show.announce') }}"><i class="bi bi-envelope-fill"></i>お知らせメール作成</a>
                </div>
            </div>
            <div class="contents__representative">
                <h3 class="representative__title">店舗代表者</h3>
                <div class="representative__register">
                    <p>総店舗代表者数: {{ $totalRepresentatives }}人</p>
                    <a href="{{ route('show.register') }}"><i class="bi bi-person-fill"></i>店舗代表者登録</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection