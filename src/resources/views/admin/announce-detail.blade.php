@extends('layouts.admin')

@section('title', 'お知らせメール詳細ページ(管理者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/announce-detail.css') }}">
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
    <div class="announce-detail">
        <h1 class="announce-detail__heading">お知らせ詳細</h1>

        <div class="announce-detail__content">
            <div class="announce-detail__content-wrapper">
                <h2 class="announce-detail__subheading">タイトル</h2>
                <p>{{ $announce->title }}</p>
            </div>

            <div class="announce-detail__content-wrapper">
                <h2 class="announce-detail__subheading">本文</h2>
                <p>{{ $announce->body }}</p>
            </div>

            <div class="announce-detail__content-wrapper">
                <h2 class="announce-detail__subheading">送信日時</h2>
                <p>{{ $announce->sent_at }}</p>
            </div>
        </div>

        <div class="announce-detail__back">
            <a class="announce-detail__link" href="{{ route('admin.users.announce') }}">戻る</a>
        </div>
    </div>
</main>
@endsection