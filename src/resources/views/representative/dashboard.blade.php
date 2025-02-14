@extends('layouts.representative')

@section('title', 'ダッシュボード(店舗代表者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative/dashboard.css') }}">
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
        <div class="dashboard__contents">
            <div class="dashboard__contents-wrapper">
                <h2 class="dashboard__subheading">店舗情報</h2>
                <div class="dashboard__function">
                    <p>店舗情報編集日: {{ $shopEditDate ?? '' }}</p>
                    <a href="{{ route('show.shop-edit') }}"><i class="bi bi-shop"></i> 店舗情報編集</a>
                </div>
                @if ($shopEditDate)
                    <div class="dashboard__function">
                        <p>メニュー数: {{ $totalMenus }}</p>
                        <a href="{{ route('show.menu-edit') }}"><i class="bi bi-book"></i> メニュー編集</a>
                    </div>
                @endif
            </div>
            <div class="dashboard__contents-wrapper">
                <h2 class="dashboard__subheading">予約状況</h2>
                <div class="dashboard__function">
                    <p>予約数: {{ $totalReservations ?? '0' }}</p>
                    <a href="{{ route('show.reservation-list') }}"><i class="bi bi-list-check"></i> 予約一覧確認</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection