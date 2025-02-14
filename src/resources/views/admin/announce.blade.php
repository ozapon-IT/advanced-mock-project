@extends('layouts.admin')

@section('title', 'お知らせメール作成ページ(管理者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/announce.css') }}">
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
    <div class="announce">
        <h1 class="announce__heading">お知らせメール</h1>

        <div class="announce__contents">
            <div class="announce__create">
                <h2 class="announce__subheading">作成</h2>

                <form class="announce__form" action="{{ route('send.announce') }}" method="POST">
                    @csrf

                    <div class="announce__form-group">
                        <label class="announce__label" for="mail-title">タイトル</label>
    
                        <input class="announce__input" type="text" name="title" id="mail-title" value="{{ old('title') }}">
    
                        @error('title')
                            <span class="error-message error-message--yellow">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <div class="announce__form-group">
                        <label class="announce__label" for="mail-body">本文</label>
    
                        <textarea class="announce__textarea" name="body" id="mail-body">{{ old('body') }}</textarea>
    
                        @error('body')
                            <span class="error-message error-message--yellow">{{ $message }}</span>
                        @enderror
                    </div>
    
                    <button class="announce__button" type="submit">送信</button>
                </form>
            </div>

            <div class="announce__history">
                <h2 class="announce__subheading">履歴</h2>

                <div class="announce__pagination">
                    {{ $announces->links('vendor.pagination.custom')}}
                </div>

                <table class="announce__table">
                    <thead>
                        <tr class="announce__table-row">
                            <th>タイトル</th>
                            <th>詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($announces as $announce)
                            <tr class="announce__table-row">
                                <td>{{ $announce->title }}</td>
                                <td><a class="announce__link" href="{{ route('show.detail', $announce) }}">詳細</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection