@extends('layouts.user')

@section('title', 'レビュー作成ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('header')
<x-header />
@endsection

@section('main')
<main>
    <div class="review">
        <h1 class="review__heading">{{ $shop->name }} のレビュー</h1>
        <div class="review__form">
            <div class="review__form-group">
                <h2 class="review__subheading">総合評価</h2>

                <div class="review__rating">
                    <input type="radio" id="star5" name="rating" value="5" form="review-form" {{ old('rating', $review ? $review->rating : '') == 5 ? 'checked' : '' }}>
                    <label for="star5"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star4" name="rating" value="4" form="review-form" {{ old('rating', $review ? $review->rating : '') == 4 ? 'checked' : '' }}>
                    <label for="star4"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star3" name="rating" value="3" form="review-form" {{ old('rating', $review ? $review->rating : '') == 3 ? 'checked' : '' }}>
                    <label for="star3"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star2" name="rating" value="2" form="review-form" {{ old('rating', $review ? $review->rating : '') == 2 ? 'checked' : '' }}>
                    <label for="star2"><i class="bi bi-star-fill"></i></label>
                    <input type="radio" id="star1" name="rating" value="1" form="review-form" {{ old('rating', $review ? $review->rating : '') == 1 ? 'checked' : '' }}>
                    <label for="star1"><i class="bi bi-star-fill"></i></label>
                </div>

                <x-validation-error field="rating" yellow="true" />
            </div>

            <div class="review__form-group">
                <h2 class="review__subheading">タイトル</h2>

                <input class="review__input" type="text" name="title" value="{{ old('title', $review ? $review->title : '') }}" form="review-form">

                <x-validation-error field="title" yellow="true" />
            </div>

            <div class="review__form-group">
                <h2 class="review__subheading">レビュー</h2>

                <textarea class="review__textarea" name="review" form="review-form">{{ old('review', $review ? $review->review : '') }}</textarea>

                <x-validation-error field="review" yellow="true" />
            </div>

            @if ($review)
                <form action="{{ route('reviews.update', $shop) }}" method="POST" id="review-form">
                    @csrf
                    @method('PATCH')
                    <button class="review__button" type="submit">再投稿する</button>
                </form>
            @else
                <form action="{{ route('reviews.store', $shop) }}" method="POST" id="review-form">
                    @csrf
                    <button class="review__button" type="submit">投稿する</button>
                </form>
            @endif
        </div>

        <div class="review__back">
            <a class="review__back-link" href="{{ route('mypage.index') }}">戻る</a>
        </div>
    </div>
</main>
@endsection