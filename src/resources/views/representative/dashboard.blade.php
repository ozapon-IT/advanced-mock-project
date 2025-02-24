@extends('layouts.representative')

@section('title', '店舗代表者ダッシュボード - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative/dashboard.css') }}">
@endsection

@section('main')
<main>
    <div class="dashboard">
        <h1 class="dashboard__heading">{{ auth()->user()->name }}さん</h1>

        <x-session-message :errors="$errors" />

        <div class="dashboard__contents">
            <div class="dashboard__section">
                <h2 class="dashboard__subheading">店舗情報</h2>

                <div class="dashboard__action">
                    <p>店舗情報編集日: {{ $shopEditDate ?? '' }}</p>

                    <a class="dashboard__link" href="{{ route('representative.shop.edit') }}"><i class="bi bi-shop"></i> 店舗情報編集</a>
                </div>

                @if ($shopEditDate)
                    <div class="dashboard__action">
                        <p>メニュー数: {{ $totalMenus }}</p>

                        <a class="dashboard__link" href="{{ route('representative.shop.menu.edit') }}"><i class="bi bi-book"></i> メニュー編集</a>
                    </div>
                @endif
            </div>

            <div class="dashboard__section">
                <h2 class="dashboard__subheading">予約状況</h2>

                <div class="dashboard__action">
                    <p>予約数: {{ $totalReservations ?? '0' }}</p>

                    <a class="dashboard__link" href="{{ route('representative.reservations.index') }}"><i class="bi bi-list-check"></i> 予約一覧確認</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection