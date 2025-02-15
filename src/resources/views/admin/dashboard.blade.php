@extends('layouts.admin')

@section('title', 'ダッシュボード(管理者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
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
    <div class="dashboard">
        <h1 class="dashboard__heading">Dashboard</h1>

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
            <div class="dashboard__contents-wrapper">
                <h2 class="dashboard__subheading">ユーザー</h2>
                <div class="dashboard__function">
                    <p>総ユーザー数: {{ $totalUsers }}人</p>
                    <a href="{{ route('show.announce') }}"><i class="bi bi-envelope-fill"></i>お知らせメール作成</a>
                </div>
            </div>
            <div class="dashboard__contents-wrapper">
                <h2 class="dashboard__subheading">店舗代表者</h2>
                <div class="dashboard__function">
                    <p>総店舗代表者数: {{ $totalRepresentatives }}人</p>
                    <a href="{{ route('show.register') }}"><i class="bi bi-person-fill"></i>店舗代表者登録</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection