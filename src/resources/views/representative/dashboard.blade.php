@extends('layouts.representative')

@section('title', 'ダッシュボード(店舗代表者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative/dashboard.css') }}">
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
        <div class="dashboard__contents">
            <div class="contents__shop-information">
                <h3 class="shop-information__title">店舗情報</h3>
                <div class="shop-information__create-or-update">
                    <p>店舗情報編集日: {{ $shopEditDate ?? '' }}</p>
                    <a href="{{ route('show.shop-edit') }}"><i class="bi bi-shop"></i> 店舗情報作成or更新</a>
                </div>
                @if ($shopEditDate)
                    <div class="shop-information__create-or-update">
                        <p>メニュー数: {{ $totalMenus }}</p>
                        <a href="{{ route('show.menu-edit') }}"><i class="bi bi-book"></i> メニュー作成or更新</a>
                    </div>
                @endif
            </div>
            <div class="contents__reservation-status">
                <h3 class="reservation-status__title">予約状況</h3>
                <div class="reservation-status__confirmation">
                    <p>予約数: {{ $totalReservations ?? '0' }}</p>
                    <a href="{{ route('show.reservation-list') }}"><i class="bi bi-list-check"></i> 予約一覧確認</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection