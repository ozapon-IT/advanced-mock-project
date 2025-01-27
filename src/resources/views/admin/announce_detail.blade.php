@extends('layouts.admin')

@section('title', 'お知らせメール詳細ページ(管理者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/announce_detail.css') }}">
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
    <div class="announce-detail">
        <h2 class="announce-detail__heading">お知らせ詳細</h2>

        <div class="announce-detail__contents">
            <div class="announce-detail__group announce-detail__title">
                <h3>タイトル</h3>
                <p>{{ $announce->title }}</p>
            </div>

            <div class="announce-detail__group announce-detail__body">
                <h3>本文</h3>
                <p>{{ $announce->body }}</p>
            </div>

            <div class="announce-detail__group announce-detail__datetime">
                <h3>送信日時</h3>
                <p>{{ $announce->sent_at }}</p>
            </div>
        </div>

        <div class="announce-detail__back">
            <a href="{{ route('show.announce') }}">戻る</a>
        </div>
    </div>
</main>
@endsection