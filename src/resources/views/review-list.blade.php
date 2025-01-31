@extends('layouts.app')

@section('title', 'レビュー一覧ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review-list.css') }}">
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
    <div class="review-list">
        <h2 class="review-list__heading">{{ $shop->name }} のレビュー一覧</h2>
        @foreach ($reviews as $review)
            <div class="review-list__card">
                <p class="review-list__username">{{ $review->user->name }}さんのレビュー</p>
                <div class="review-list__rating">
                    @php
                        $fullStars = floor($review->rating);
                        $halfStar = ($review->rating - $fullStars) >= 0.5 ? 1 : 0;
                        $emptyStars = 5 - ($fullStars + $halfStar);
                    @endphp
                    @for ($i = 0; $i < $fullStars; $i++)
                        <i class="bi bi-star-fill"></i>
                    @endfor
                    @if ($halfStar)
                        <i class="bi bi-star-half"></i>
                    @endif
                    @for ($i = 0; $i < $emptyStars; $i++)
                        <i class="bi bi-star"></i>
                    @endfor
                </div>
                <p class="review-list__title">{{ $review->title }}</p>
                <p class="review-list__review">{{ $review->review }}</p>
            </div>
        @endforeach
        <div class="review-list__pagination">
            {{ $reviews->links('vendor.pagination.custom') }}
        </div>
    </div>
</main>
@endsection