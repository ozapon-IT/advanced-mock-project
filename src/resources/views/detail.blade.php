@extends('layouts.user')

@section('title', '飲食店詳細ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('header')
<x-header />
@endsection

@section('main')
<main>
    <div class="detail">
        <div class="detail__content">
            <div class="detail__shop-name-container">
                @if (request('from') === 'mypage')
                    <a class="detail__back-link" href="{{ route('mypage.index') }}" aria-label="前のページに戻る">&lt;</a>
                @else
                    <a class="detail__back-link" href="{{ route('index') }}" aria-label="前のページに戻る">&lt;</a>
                @endif
                <h1 class="detail__shop-name">{{ $shop->name }}</h1>
            </div>

            <div class="detail__shop-image-container">
                <img class="detail__shop-image" src="{{ Storage::disk('s3')->url($shop->image_path) }}" alt="{{ $shop->name .'の店舗画像' }}">
            </div>

            <div class="detail__shop-description">
                <p class="detail__shop-area">#{{ $shop->area->name }}</p>

                <p class="detail__shop-genre">#{{ $shop->genre->name }}</p>

                <p class="detail__shop-summary">{{ $shop->summary }}</p>

                <ul class="detail__shop-menu">
                    @foreach ($menus as $menu)
                        <li class="detail__shop-menu-item">{{ $menu->name }} {{ formattedTotalAmount($menu->price) }}</li>
                    @endforeach
                </ul>

                <div class="detail__shop-rating-container">
                    <div class="detail__shop-rating">
                        <x-rating-stars :rating="$shop->average_rating" showValue="true" />
                    </div>

                    <div class="detail__shop-reviews">
                        @if (request('from') === 'mypage')
                            <a class="detail__shop-reviews-link" href="{{ route('reviews.index', $shop) . '?from=mypage' }}" aria-label="レビューを見る"><i class="bi bi-chat-dots"></i></a>
                        @else
                            <a class="detail__shop-reviews-link" href="{{ route('reviews.index', $shop) . '?from=top' }}" aria-label="レビューを見る"><i class="bi bi-chat-dots"></i></a>
                        @endif

                        <span class="detail__shop-reviews-number">{{ $shop->reviews->count() }}</span>
                    </div>

                    <div class="detail__shop-favorites" aria-label="お気に入り数">
                        <i class="bi bi-suit-heart-fill"></i>

                        <span class="detail__shop-favorites-number">{{ $shop->favorites->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="detail__reservation">
            <div class="detail__reservation-wrapper">
                <h2 class="detail__reservation-heading">予約</h2>

                <div class="detail__reservation-form">
                    <div class="detail__reservation-date">
                        <input class="detail__input" type="text" name="reservation_date" value="{{ old('reservation_date') }}" form="reservation-form" id="reservation-date" placeholder="予約日">

                        <button  class="detail__button detail__button--calendar" type="button">
                            <i class="bi bi-calendar"></i>
                        </button>
                    </div>

                    <x-validation-error field="reservation_date" yellow="true" />

                    <div class="detail__reservation-time">
                        <select class="detail__select" name="reservation_time" form="reservation-form" id="reservation-time">
                            <option value="" disabled {{ old('reservation_time') ? '' : 'selected'}}>予約時間</option>

                            @foreach (generateReservationTimes() as $time)
                                <option value="{{ $time }}" {{ old('reservation_time') == $time ? 'selected' : ''}}>{{ $time }}</option>
                            @endforeach
                        </select>
                    </div>

                    <x-validation-error field="reservation_time" yellow="true" />

                    <div class="detail__reservation-number">
                        <select class="detail__select" name="number_of_people" form="reservation-form" id="reservation-number">
                            <option value="" disabled {{ old('number_of_people') ? '' : 'selected'}}>予約人数</option>

                            @foreach (generateReservationNumbers() as $number)
                                <option value="{{ $number }}" {{ old('number_of_people') == $number ? 'selected' : ''}}>{{ $number }}</option>
                            @endforeach
                        </select>
                    </div>

                    <x-validation-error field="number_of_people" yellow="true" />

                    <div class="detail__reservation-menu">
                        <select class="detail__select" name="reservation_menu" form="reservation-form" id="reservation-menu">
                            <option value="" disabled {{ old('menu') ? '' : 'selected'}}>予約メニュー</option>

                            @foreach (generateReservationMenus($shop->id) as $menu)
                                <option value="{{ $menu }}" {{ old('menu') == $menu ? 'selected' : ''}}>{{ $menu }}</option>
                            @endforeach
                        </select>
                    </div>

                    <x-validation-error field="reservation_menu" yellow="true" />

                    <div class="detail__payment-method">
                        <select class="detail__select" name="payment_method" form="reservation-form" id="payment-method">
                            <option value="" disabled {{ old('payment_method') ? '' : 'selected'}}>支払い方法</option>

                            <option value="カード払い" {{ old('payment_method') == 'カード払い' ? 'selected' : ''}}>カード払い</option>
                        </select>
                    </div>

                    <x-validation-error field="payment_method" yellow="true" />
                </div>

                <div class="detail__reservation-confirmation">
                    <x-reservation-details-table :shop="$shop" type="detail" />
                </div>
            </div>

            @guest
                <form action="{{ route('login') }}" method="GET">
                    <button class="detail__button detail__button--reservation" type="submit">予約する</button>
                </form>
            @endguest

            @auth
                @if (auth()->user()->isUser())
                    <form action="{{ route('reservations.store', $shop->id) }}" id="reservation-form" method="POST">
                        @csrf
                        <input type="hidden" name="from" value="{{ request('from') }}">
                        <button class="detail__button detail__button--reservation" type="submit">予約する</button>
                    </form>
                @else
                    <button class="detail__button detail__button--reservation">予約する</button>
                @endif
            @endauth
        </div>
    </div>
</main>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dateInput = document.getElementById('reservation-date');
        const calendarIcon = document.querySelector('.detail__button--calendar');

        flatpickr("#reservation-date", {
            dateFormat: "Y-m-d",
            locale: "ja",
        });

        calendarIcon.addEventListener('click', () => {
            dateInput._flatpickr.open();
        })
    });

    document.addEventListener('DOMContentLoaded', () => {
        const dateInput = document.getElementById('reservation-date');
        const timeSelect = document.getElementById('reservation-time');
        const numberSelect = document.getElementById('reservation-number');
        const menuSelect = document.getElementById('reservation-menu');
        const paymentSelect = document.getElementById('payment-method')

        const tableDate = document.getElementById('table-reservation-date');
        const tableTime = document.getElementById('table-reservation-time');
        const tableNumber = document.getElementById('table-reservation-number');
        const tableMenu = document.getElementById('table-reservation-menu');
        const tablePayment = document.getElementById('table-payment-method');

        dateInput.addEventListener('change', () => {
            tableDate.textContent = dateInput.value || '未選択';
        });

        timeSelect.addEventListener('change', () => {
            tableTime.textContent = timeSelect.value || '未選択';
        });

        numberSelect.addEventListener('change', () => {
            tableNumber.textContent = numberSelect.value || '未選択';
        });

        menuSelect.addEventListener('change', () => {
            tableMenu.textContent = menuSelect.value || '未選択';
        });

        paymentSelect.addEventListener('change', () => {
            tablePayment.textContent = paymentSelect.value || '未選択';
        });

        const tablePrice = document.getElementById('table-reservation-price');

        const shopId = {{ $shop->id }};

        const updatePrice = async () => {
            const numberOfPeople = parseInt(numberSelect.value || 0);
            const menuName = menuSelect.value || '';

            if (!numberOfPeople || !menuName) {
                tablePrice.textContent = '未選択';
                return;
            }

            try {
                const response = await fetch(`/api/calculate-total?shop_id=${shopId}&menu_name=${encodeURIComponent(menuName)}&number_of_people=${numberOfPeople}`);
                if (response.ok) {
                    const data = await response.json();
                    tablePrice.textContent = data.formatted_amount;
                } else {
                    tablePrice.textContent = 'エラー';
                }
            } catch (error) {
                console.error('Error calculating total amount:', error);
                tablePrice.textContent = 'エラー';
            }
        };

        numberSelect.addEventListener('change', updatePrice);
        menuSelect.addEventListener('change', updatePrice);
    });
</script>
@endsection
