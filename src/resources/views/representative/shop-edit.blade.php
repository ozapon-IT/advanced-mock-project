@extends('layouts.representative')

@section('title', '店舗情報編集ページ(店舗代表者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative/shop-edit.css') }}">
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
    <div class="shop-edit">
        <h2 class="shop-edit__title">店舗情報作成or更新</h2>
        <div class="shop-edit__contents">
            <div class="contents__edit">
                <h3 class="edit__title">編集</h3>
                <div class="edit__form">
                    <section class="form__section">
                        <h4 class="section__title">店舗名</h4>
                        <input class="section__input shop-name" type="text" name="name" value="{{ old('name') }}" form="shop-edit-form">
                    </section>
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <section class="form__section">
                        <h4 class="section__title">店舗画像</h4>
                        <label class="section__image--button" for="shop-image">
                            画像選択
                            <input class="section__input--image" type="file" name="image" value="{{ old('image') }}" accept=".jpeg,.png" id="shop-image" form="shop-edit-form">
                        </label>
                    </section>
                    @error('image')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <section class="form__section">
                        <h4 class="section__title">エリア</h4>
                        <select class="section__select" name="area" form="shop-edit-form">
                            <option disabled {{ old('area') ? '' : 'selected'}}>エリア選択</option>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}" {{ request('area') == $area->id ? 'selected' : ''}}>{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </section>
                    @error('area')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <section class="form__section">
                        <h4 class="section__title">ジャンル</h4>
                        <select class="section__select" name="genre" form="shop-edit-form">
                            <option disabled {{ old('genre') ? '' : 'selected'}}>ジャンル選択</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : ''}}>{{ $genre->name }}</option>
                            @endforeach
                        </select>
                    </section>
                    @error('genre')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <section class="form__section">
                        <h4 class="section__title">店舗概要</h4>
                        <textarea class="section__textarea" name="summary" value="{{ old('summary') }}" form="shop-edit-form"></textarea>
                    </section>
                    @error('summary')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="contents__confirmation">
                <h3 class="confirmation__title">確認</h3>
                <div class="confirmation__detail">
                    <p class="detail__shop-name" id="shop-name-preview">{{ $shop->name ?? '' }}</p>

                    <div class="detail__shop-image">
                        <img class="shop-image {{ $shop?->image_path ? 'shop-image--visible' : '' }}" id="shop-image-preview" src="{{ $shop?->image_path ? asset('storage/' . $shop->image_path) : '' }}" alt="店舗画像">
                    </div>

                    <p class="detail__shop-area" id="shop-area-preview">{{ $shop?->area?->name ? '#' . $shop?->area?->name : '' }}</p>

                    <p class="detail__shop-genre" id="shop-genre-preview">{{ $shop?->genre?->name ? '#' . $shop?->genre?->name : '' }}</p>

                    <p class="detail__shop-summary" id="shop-summary-preview">{{ $shop->summary ?? ''}}</p>

                    @if ($shop)
                        <form action="{{ route('update.shop-information', $shop) }}" method="POST" id="shop-edit-form" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <button class="detail__button" type="submit">更新する</button>
                        </form>
                    @else
                        <form action="{{ route('create.shop-information') }}" method="POST" id="shop-edit-form" enctype="multipart/form-data">
                            @csrf
                            <button class="detail__button" type="submit">作成する</button>
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
        const shopNameInput = document.querySelector('.shop-name');
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
                    shopImagePreview.classList.add('shop-image--visible');
                };
                reader.readAsDataURL(file);
            } else {
                shopImagePreview.src = "";
                shopImagePreview.classList.remove('shop-image--visible');
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
        const shopSummaryInput = document.querySelector('.section__textarea');
        const shopSummaryPreview = document.getElementById('shop-summary-preview');
        shopSummaryInput.addEventListener('input', () => {
            shopSummaryPreview.textContent = shopSummaryInput.value;
        })
    });
</script>
@endsection