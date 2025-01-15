@extends('layouts.app')

@section('title', '飲食店一覧ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
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
        <div class="header__search">
            <div class="search__box">
                <select class="search__select search__area" name="area" form="search-form">
                    <option value="All area" {{ request('area') === 'All area' ? 'selected' : ''}}>All area</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area }}" {{ request('area') === $area ? 'selected' : ''}}>{{ $area }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search__box">
                <select class="search__select search__genre" name="genre" form="search-form">
                    <option value="All genre" {{ request('genre') === 'All genre' ? 'selected' : ''}}>All genre</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre }}" {{ request('genre') === $genre ? 'selected' : ''}}>{{ $genre }}</option>
                    @endforeach
                </select>
            </div>
            <form action="{{ route('top') }}" id="search-form" method="GET">
                <button class="search__button" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
            <input class="search__text" type="text" name="text" placeholder="Search ..." form="search-form" value="{{ request('text') }}">
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
                    <h2 class="shop-list__name">{{ $shop->name }}</h2>
                    <p class="shop-list__area">#{{ $shop->area }}</p>
                    <p class="shop-list__genre">#{{ $shop->genre }}</p>
                    <a class="shop-list__detail" href="/detail/{shop_id}">詳しくみる</a>
                    <button class="shop-list__favorite">
                        <i class="bi bi-suit-heart-fill favorite--addition"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</main>
@endsection