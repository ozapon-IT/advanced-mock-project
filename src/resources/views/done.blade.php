@extends('layouts.user')

@section('title', '予約完了ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('header')
<x-header />
@endsection

@section('main')
<main>
    <div class="done">
        <div class="done__wrapper">
            <p class="done__message">ご予約ありがとうございます</p>
            <a class="done__back-link" href="{{ request('from') === 'mypage' ? route('mypage.index') : route('index') }}">戻る</a>
        </div>
    </div>
</main>
@endsection