@extends('layouts.app')

@section('title', 'マイページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
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
    <div class="mypage">
        <h2 class="mypage__name">
            testさん
        </h2>
        <div class="mypage__content">
            <div class="content__reservation-status">
                <h3 class="reservation-status__title">予約状況</h3>
                <div class="reservation-status__card">
                    <div class="card__number">
                        <i class="bi bi-clock-fill"></i>
                        <p>予約1</p>
                    </div>
                    <table class="card__table">
                        <thead>
                            <tr>
                                <th>Shop</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>仙人</td>
                                <td>2021-04-01</td>
                                <td>17:00</td>
                                <td>1人</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="card__delete-button">
                        <form action="">
                            <button type="submit"><i class="bi bi-x-circle"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="content__favorite">
                <h3 class="favorite__title">お気に入り店舗</h3>
                <div class="favorite__shop-list">
                    <div class="shop-list__card">
                        <div class="shop-list__image">
                            <img src="" alt="">
                        </div>
                        <div class="shop-list__content">
                            <h2 class="shop-list__name">仙人</h2>
                            <p class="shop-list__area">#東京都</p>
                            <p class="shop-list__genre">#寿司</p>
                            <a class="shop-list__detail" href="/detail/{shop_id}">詳しくみる</a>
                            <button class="shop-list__favorite">
                                <i class="bi bi-suit-heart-fill"></i>
                            </button>
                        </div>
                    </div>
                    <div class="shop-list__card">
                        <div class="shop-list__image">
                            <img src="" alt="">
                        </div>
                        <div class="shop-list__content">
                            <h2 class="shop-list__name">牛助</h2>
                            <p class="shop-list__area">#大阪府</p>
                            <p class="shop-list__genre">#焼肉</p>
                            <a class="shop-list__detail" href="">詳しくみる</a>
                            <button class="shop-list__favorite">
                                <i class="bi bi-suit-heart-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection