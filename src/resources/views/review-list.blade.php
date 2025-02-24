@extends('layouts.user')

@section('title', 'レビュー一覧ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review-list.css') }}">
@endsection

@section('header')
<x-header />
@endsection

@section('main')
<main>
    <div class="review-list">
        <h1 class="review-list__heading">{{ $shop->name }} のレビュー一覧</h1>

        @foreach ($reviews as $review)
            <div class="review-list__card">
                <p class="review-list__username">{{ $review->user->name }}さんのレビュー</p>

                <div class="review-list__rating">
                    <x-rating-stars :rating="$review->rating" />
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