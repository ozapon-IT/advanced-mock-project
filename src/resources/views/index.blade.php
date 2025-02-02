@extends('layouts.app')

@section('title', '飲食店一覧ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
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
        <div class="header__search">
            <div class="header__search-group">
                <select class="header__search-select" name="area" form="search-form">
                    <option value="All area" {{ request('area') === 'All area' ? 'selected' : ''}}>All area</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{ request('area') == $area->id ? 'selected' : ''}}>{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="header__search-group">
                <select class="header__search-select" name="genre" form="search-form">
                    <option value="All genre" {{ request('genre') === 'All genre' ? 'selected' : ''}}>All genre</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : ''}}>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <form action="{{ route('top.show') }}" id="search-form" method="GET">
                <button class="header__search-button" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
            <input class="header__search-input" type="text" name="text" placeholder="Search ..." form="search-form" value="{{ request('text') }}">
        </div>
    </div>
</header>
@endsection

@section('main')
<main>
    <div class="shop-list">
        @foreach ($shops as $shop)
            <div class="shop-list__card">
                <div class="shop-list__image">
                    <img src="{{ asset('storage/' . $shop->image_path) }}" alt="{{ $shop->name . 'の店舗画像' }}">
                </div>
                <div class="shop-list__content">
                    <h2 class="shop-list__name">{{ mb_strimwidth($shop->name, 0, 15, "...") }}</h2>
                    <p class="shop-list__area">#{{ $shop->area->name }}</p>
                    <p class="shop-list__genre">#{{ $shop->genre->name }}</p>
                    <a class="shop-list__detail" href="{{ route('detail.show', $shop->id) . '?from=top' }}" aria-label="{{ $shop->name }}の詳細を見る">詳しくみる</a>
                    @guest
                        <a class="shop-list__favorite" href="{{ route('login') }}">
                            <i class="bi bi-suit-heart-fill"></i>
                        </a>
                    @endguest

                    @auth
                        <button
                            class="shop-list__favorite js-favorite-button"
                            aria-label="{ $shop->favorites->contains('user_id', auth()->id()) ? 'お気に入りを解除' : 'お気に入りに追加'}"
                            data-shop-id="{{ $shop->id }}"
                            data-favorited="{{ $shop->favorites->contains('user_id', auth()->id()) ? 'true' : 'false' }}"
                        >
                            <i
                                class="bi bi-suit-heart-fill {{ $shop->favorites->contains('user_id', auth()->id()) ? 'bi-suit-heart-fill--red' : '' }}">
                            </i>
                        </button>
                    @endauth

                    <div class="shop-list__rating">
                        @php
                            $averageRating = $shop->average_rating ?? 0;
                            $fullStars = floor($averageRating);
                            $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
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
                </div>
            </div>
        @endforeach
    </div>
</main>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const favoriteButtons = document.querySelectorAll('.js-favorite-button');
        favoriteButtons.forEach(button => {
            button.addEventListener('click', async (e) => {
                e.preventDefault();

                const shopId = button.getAttribute('data-shop-id');
                const isFavorited = button.getAttribute('data-favorited') === 'true';

                const url = `/favorite/${shopId}`;
                const method = isFavorited ? 'DELETE' : 'POST';

                try {
                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type' : 'application/json',
                        }
                    });

                    if (response.ok) {
                        button.setAttribute('data-favorited', isFavorited ? 'false' : 'true');

                        const icon = button.querySelector('i');
                        icon.classList.toggle('bi-suit-heart-fill--red');
                    } else {
                        console.error('お気に入りの更新に失敗しました。');
                    }
                } catch (error) {
                    console.error('通信エラー:', error)
                }
            });
        });
    });
</script>
@endsection