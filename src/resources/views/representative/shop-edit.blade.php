@extends('layouts.representative')

@section('title', '店舗情報編集ページ(店舗代表者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative/shop-edit.css') }}">
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
    <div class="shop-information">
        <h2 class="shop-information__title">店舗情報</h2>
        <div class="shop-information__contents">
            <div class="contents__edit">
                <h3 class="edit__title">編集</h3>
                <div class="edit__form">
                    <div class="form__group">
                        <label class="form__label" for="shop-name">店舗名</label>
                        <input class="form__input shop-name" type="text" name="name" id="shop-name" value="" form="shop-edit-form">
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="shop-image">店舗画像</label>
                        <input class="form__input shop-image" type="text" name="image" id="shop-image" value="" form="shop-edit-form">
                    </div>
                    <div class="form__group">
                        <div class="select__group">
                            <label class="form__label" for="shop-area">エリア</label>
                            <select class="form__select" name="area" id="shop-area" form="shop-edit-form">
                                <option value="">エリア選択</option>
                            </select>
                        </div>
                        <div class="select__group">
                            <label class="form__label" for="shop-genre">ジャンル</label>
                            <select class="form__select" name="genre" id="shop-genre" form="shop-edit-form">
                                <option value="">ジャンル選択</option>
                            </select>
                        </div>
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="shop-summary">店舗概要</label>
                        <textarea class="form__textarea" name="summary" id="shop-summary" value="" form="shop-edit-form"></textarea>
                    </div>
                </div>
            </div>
            <div class="contents__confirmation">
                <h3 class="confirmation__title">確認</h3>
                <div class="confirmation__detail">
                    <div class="detail__shop-name">
                        <p>店舗名</p>
                        <p>{{-- 入力した内容を即時反映 --}}</p>
                    </div>
                    <div class="detail__shop-image">
                        <p>店舗画像</p>
                        <!-- 入力した画像を即時反映 -->
                        <div><img src="" alt=""></div>
                    </div>
                    <div class="detail__shop-area">
                        <p>エリア</p>
                        <p>{{-- 選択した内容を即時反映 --}}</p>
                    </div>
                    <div class="detail__shop-genre">
                        <p>ジャンル</p>
                        <p>{{-- 選択した内容を即時反映 --}}</p>
                    </div>
                    <div class="detail__shop-summary">
                        <p>店舗概要</p>
                        <p>{{-- 入力した内容を即時反映 --}}</p>
                    </div>
                    <form action="" method="POST" id="shop-edit-form">
                        @csrf
                        <button class="detail__button" type="submit">作成する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection