@extends('layouts.representative')

@section('title', '店舗情報編集ページ(店舗代表者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative/shop-edit.css') }}">
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
    <div class="shop-edit">
        <h1 class="shop-edit__heading">店舗情報編集</h1>

        <div class="shop-edit__contents">
            <div class="shop-edit__contents-wrapper">
                <h2 class="shop-edit__subheading">編集</h2>

                <div class="shop-edit__form">
                    <div class="shop-edit__form-group">
                        <p>店舗名</p>

                        <input class="shop-edit__input" type="text" name="name" value="{{ old('name', $shop ? $shop->name : '') }}" form="shop-edit-form">
                    </div>
                    @error('name')
                        <span class="error-message error-message--yellow">{{ $message }}</span>
                    @enderror

                    <div class="shop-edit__form-group">
                        <p>店舗画像</p>

                        <label class="shop-edit__label--image-select" for="shop-image">
                            画像選択
                            <input class="shop-edit__input--image" type="file" name="image" value="{{ old('image') }}" accept=".jpeg,.png" id="shop-image" form="shop-edit-form">
                        </label>
                    </div>
                    @error('image')
                        <span class="error-message error-message--yellow">{{ $message }}</span>
                    @enderror

                    <div class="shop-edit__form-group">
                        <p>エリア</p>

                        <select class="shop-edit__select" name="area" form="shop-edit-form">
                            <option disabled {{ old('area') ? '' : 'selected'}}>エリア選択</option>

                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}" {{ old('area', $shop ? $shop->area_id : '') == $area->id ? 'selected' : ''}}>{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('area')
                        <span class="error-message error-message--yellow">{{ $message }}</span>
                    @enderror

                    <div class="shop-edit__form-group">
                        <p>ジャンル</p>

                        <select class="shop-edit__select" name="genre" form="shop-edit-form">
                            <option disabled {{ old('genre') ? '' : 'selected'}}>ジャンル選択</option>

                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" {{ old('genre', $shop ? $shop->genre_id : '') == $genre->id ? 'selected' : ''}}>{{ $genre->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('genre')
                        <span class="error-message error-message--yellow">{{ $message }}</span>
                    @enderror

                    <div class="shop-edit__form-group">
                        <p>店舗概要</p>

                        <textarea class="shop-edit__textarea" name="summary" form="shop-edit-form">{{ old('summary', $shop ? $shop->summary : '') }}</textarea>
                    </div>
                    @error('summary')
                        <span class="error-message error-message--yellow">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="shop-edit__contents-wrapper">
                <h2 class="shop-edit__subheading">確認</h2>
                <div class="shop-edit__confirmation">
                    <p class="shop-edit__shop-name" id="shop-name-preview">{{ $shop->name ?? '' }}</p>

                    <div class="shop-edit__shop-image">
                        <img class="shop-edit__image {{ $shop?->image_path ? 'shop-edit__image--visible' : '' }}" id="shop-image-preview" src="{{ $shop?->image_path ? asset('storage/' . $shop->image_path) : '' }}" alt="店舗画像">
                    </div>

                    <p class="shop-edit__shop-area" id="shop-area-preview">{{ $shop?->area?->name ? '#' . $shop?->area?->name : '' }}</p>

                    <p class="shop-edit__shop-genre" id="shop-genre-preview">{{ $shop?->genre?->name ? '#' . $shop?->genre?->name : '' }}</p>

                    <p class="shop-edit__shop-summary" id="shop-summary-preview">{{ $shop->summary ?? ''}}</p>

                    @if ($shop)
                        <form action="{{ route('representative.shop.update', $shop) }}" method="POST" id="shop-edit-form" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <button class="shop-edit__button" type="submit">更新する</button>
                        </form>
                    @else
                        <form action="{{ route('representative.shop.store') }}" method="POST" id="shop-edit-form" enctype="multipart/form-data">
                            @csrf
                            <button class="shop-edit__button" type="submit">作成する</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // 店舗名
        const shopNameInput = document.querySelector('.shop-edit__input');
        const shopNamePreview = document.getElementById('shop-name-preview');
        shopNameInput.addEventListener('input', () => {
            shopNamePreview.textContent = shopNameInput.value;
        })

        // 店舗画像
        const shopImageInput = document.getElementById('shop-image');
        const shopImagePreview = document.getElementById('shop-image-preview');
        shopImageInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    shopImagePreview.src = e.target.result;
                    shopImagePreview.classList.add('shop-edit__image--visible');
                };
                reader.readAsDataURL(file);
            } else {
                shopImagePreview.src = "";
                shopImagePreview.classList.remove('shop-edit__image--visible');
            }
        });

        // エリア
        const shopAreaSelect = document.querySelector('select[name="area"]');
        const shopAreaPreview = document.getElementById('shop-area-preview');
        shopAreaSelect.addEventListener('change', () => {
            const selectedIndex = shopAreaSelect.selectedIndex;
            shopAreaPreview.textContent = `#${shopAreaSelect.options[selectedIndex].text}`;
        });

        // ジャンル
        const shopGenreSelect = document.querySelector('select[name="genre"]');
        const shopGenrePreview = document.getElementById('shop-genre-preview');
        shopGenreSelect.addEventListener('change', () => {
            const selectedIndex = shopGenreSelect.selectedIndex;
            shopGenrePreview.textContent = `#${shopGenreSelect.options[selectedIndex].text}`;
        });

        // 店舗概要
        const shopSummaryInput = document.querySelector('.shop-edit__textarea');
        const shopSummaryPreview = document.getElementById('shop-summary-preview');
        shopSummaryInput.addEventListener('input', () => {
            shopSummaryPreview.textContent = shopSummaryInput.value;
        })
    });
</script>
@endsection