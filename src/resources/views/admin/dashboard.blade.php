@extends('layouts.admin')

@section('title', '管理者ダッシュボード - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endsection

@section('main')
<main>
    <div class="dashboard">
        <h1 class="dashboard__heading">{{ auth()->user()->name }}</h1>

        <x-session-message :errors="$errors" />

        <div class="dashboard__contents">
            <div class="dashboard__section">
                <h2 class="dashboard__subheading">ユーザー</h2>

                <div class="dashboard__action">
                    <p>総ユーザー数: {{ $totalUsers }}人</p>

                    <a class="dashboard__link" href="{{ route('admin.users.announcements.create') }}"><i class="bi bi-envelope-fill"></i>お知らせメール作成</a>
                </div>
            </div>

            <div class="dashboard__section">
                <h2 class="dashboard__subheading">店舗代表者</h2>

                <div class="dashboard__action">
                    <p>総店舗代表者数: {{ $totalRepresentatives }}人</p>

                    <a class="dashboard__link" href="{{ route('admin.representatives.create') }}"><i class="bi bi-person-fill"></i>店舗代表者登録</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection