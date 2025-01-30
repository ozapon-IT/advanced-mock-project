@extends('layouts.app')

@section('title', 'レビューページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
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
    <div class="review">
        <h2 class="review__heading">{{ $shop->name }} のレビュー</h2>
        <div class="review__form">
            <div class="review__field">
                <h3 class="review__subheading">総合評価</h3>
                <div class="review__rating">
                    <input type="radio" id="star5" name="rating" value="5" form="review-form">
                    <label for="star5"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star4" name="rating" value="4" form="review-form">
                    <label for="star4"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star3" name="rating" value="3" form="review-form">
                    <label for="star3"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star2" name="rating" value="2" form="review-form">
                    <label for="star2"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star1" name="rating" value="1" form="review-form">
                    <label for="star1"><i class="bi bi-star-fill"></i></label>
                </div>
            </div>
            <div class="review__field">
                <h3 class="review__subheading">タイトル</h3>
                <input class="review__input" type="text" name="title" value="" form="review-form">
            </div>
            <div class="review__field">
                <h3 class="review__subheading">レビュー</h3>
                <textarea class="review__textarea" name="" form="review-form"></textarea>
            </div>
            <form action="" method="POST" id="review-form">
                @csrf
                <button class="review__button" type="submit">投稿する</button>
            </form>
        </div>
    </div>
</main>
@endsection