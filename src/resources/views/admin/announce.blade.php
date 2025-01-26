@extends('layouts.admin')

@section('title', 'お知らせメール作成ページ(管理者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/announce.css') }}">
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
    <div class="announce">
        <h2 class="announce__title">お知らせメール</h2>

        <div class="announce__form">
            <form action="{{ route('send.announce') }}" method="POST">
                @csrf

                <div class="announce__group">
                    <label class="announce__label" for="mail-title">タイトル</label>

                    <input class="announce__input" type="text" name="title" id="mail-title" value="{{ old('title') }}">

                    @error('title')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="announce__group">
                    <label class="announce__label" for="mail-body">本文</label>

                    <textarea class="announce__textarea" name="body" id="mail-body">{{ old('body') }}</textarea>

                    @error('body')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <button class="announce__button" type="submit">送信</button>
            </form>
        </div>
    </div>
</main>
@endsection