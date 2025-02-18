@extends('layouts.admin')

@section('title', 'お知らせメール詳細ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/announce-detail.css') }}">
@endsection

@section('main')
<main>
    <div class="announce-detail">
        <h1 class="announce-detail__heading">お知らせ詳細</h1>

        <div class="announce-detail__content">
            <div class="announce-detail__section">
                <h2 class="announce-detail__subheading">タイトル</h2>
                <p>{{ $announce->title }}</p>
            </div>

            <div class="announce-detail__section">
                <h2 class="announce-detail__subheading">本文</h2>
                <p>{{ $announce->body }}</p>
            </div>

            <div class="announce-detail__section">
                <h2 class="announce-detail__subheading">送信日時</h2>
                <p>{{ $announce->sent_at }}</p>
            </div>
        </div>

        <div class="announce-detail__back">
            <a class="announce-detail__back-link" href="{{ route('admin.users.announcements.create') }}">戻る</a>
        </div>
    </div>
</main>
@endsection