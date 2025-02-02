@extends('layouts.app')

@section('title', 'レビュー一覧ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review-list.css') }}">
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
    <div class="review-list">
        <h1 class="review-list__heading">{{ $shop->name }} のレビュー一覧</h1>
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
        <div class="review-list__back">
            @if (request('from') === 'mypage')
                <a class="review-list__back-link" href="{{ route('detail.show', $shop->id) . '?from=mypage' }}">戻る</a>
            @else
                <a class="review-list__back-link" href="{{ route('detail.show', $shop->id) . '?from=top'}}">戻る</a>
            @endif
        </div>
    </div>
</main>
@endsection