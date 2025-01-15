@extends('layouts.app')

@section('title', '飲食店詳細ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
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
    <div class="detail">
        <div class="detail__content">
            <div class="content__name">
                <a href="">&lt;</a>
                <h2>仙人</h2>
            </div>

            <div class="content__image">
                <img src="" alt="">
            </div>

            <div class="content__description">
                <p class="description__area">#東京都</p>
                <p class="description__genre">#寿司</p>
                <p class="description__summary">料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみ下さい。食材・味・価格、お客様の満足度を徹底的に追求したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。</p>
            </div>
        </div>
        <div class="detail__reservation">
            <form class="reservation__form" action="">
                <h2 class="reservation__title">予約</h2>

                <div class="reservation__field">
                    <input class="field__date" type="date" name="reservation_date" value="">
                    <div class="field__select">
                        <select class="select__time" name="reservation_time" id="">
                            <option value="">予約時間</option>
                            <option value="">17:00</option>
                        </select>
                    </div>
                    <div class="field__select">
                        <select class="select__number" name="number_of_people" id="">
                            <option value="">予約人数</option>
                            <option value="">1人</option>
                        </select>
                    </div>
                </div>

                <div class="reservation__confirmation">
                    <table class="confirmation__table">
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
                </div>
            </form>

            <div class="reservation__button">
                <button type="submit">予約する</button>
            </div>
        </div>
    </div>
</main>
@endsection