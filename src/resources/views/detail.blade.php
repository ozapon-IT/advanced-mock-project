@extends('layouts.app')

@section('title', '飲食店詳細ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
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
    <div class="detail">
        <div class="detail__content">
            <div class="content__name">
                @if (request('from') === 'mypage')
                    <a href="{{ route('mypage.show') }}">&lt;</a>
                @else
                    <a href="{{ route('top.show') }}">&lt;</a>
                @endif
                <h2>{{ $shop->name }}</h2>
            </div>

            <div class="content__image">
                <img src="{{ asset('storage/' . $shop->image_path) }}" alt="{{ $shop->name .'の店舗画像' }}">
            </div>

            <div class="content__description">
                <p class="description__area">#{{ $shop->area }}</p>
                <p class="description__genre">#{{ $shop->genre }}</p>
                <p class="description__summary">{{ $shop->summary }}</p>
                <ul class="description__menu">
                    @foreach ($menus as $menu)
                        <li>{{ $menu->name }} {{ formattedTotalAmount($menu->price) }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="detail__reservation">
            <div class="reservation__form">
                <h2 class="reservation__title">予約</h2>

                <div class="reservation__field">
                    <div class="field__input">
                        <input class="input__date" type="text" name="reservation_date" value="{{ old('reservation_date') }}" form="reservation-form" id="reservation-date" placeholder="予約日">
                        <button  class="input__calendar" type="button">
                            <i class="bi bi-calendar"></i>
                        </button>
                    </div>

                    @error('reservation_date')
                        <span class="error-message">{{ $message }}</span>
                    @enderror

                    <div class="field__select">
                        <select class="select__time" name="reservation_time" form="reservation-form" id="reservation-time">
                            <option value="" disabled {{ old('reservation_time') ? '' : 'selected'}}>予約時間</option>
                            @foreach (generateReservationTimes() as $time)
                                <option value="{{ $time }}" {{ old('reservation_time') == $time ? 'selected' : ''}}>{{ $time }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('reservation_time')
                        <span class="error-message">{{ $message }}</span>
                    @enderror

                    <div class="field__select">
                        <select class="select__number" name="number_of_people" form="reservation-form" id="reservation-number">
                            <option value="" disabled {{ old('number_of_people') ? '' : 'selected'}}>予約人数</option>
                            @foreach (generateReservationNumbers() as $number)
                                <option value="{{ $number }}" {{ old('number_of_people') == $number ? 'selected' : ''}}>{{ $number }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('number_of_people')
                        <span class="error-message">{{ $message }}</span>
                    @enderror

                    <div class="field__select">
                        <select class="select__menu" name="reservation_menu" form="reservation-form" id="reservation-menu">
                            <option value="" disabled {{ old('menu') ? '' : 'selected'}}>予約メニュー</option>
                            @foreach (generateReservationMenus($shop->id) as $menu)
                                <option value="{{ $menu }}" {{ old('menu') == $menu ? 'selected' : ''}}>{{ $menu }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('reservation_menu')
                        <span class="error-message">{{ $message }}</span>
                    @enderror

                    <div class="field__select">
                        <select class="select__payment" name="payment_method" form="reservation-form" id="payment-method">
                            <option value="" disabled {{ old('payment_method') ? '' : 'selected'}}>支払い方法</option>

                            <option value="コンビニ払い" {{ old('payment_method') == 'コンビニ払い' ? 'selected' : ''}}>コンビニ払い</option>

                            <option value="カード払い" {{ old('payment_method') == 'カード払い' ? 'selected' : ''}}>カード払い</option>
                        </select>
                    </div>

                    @error('payment_method')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="reservation__confirmation">
                    <table class="confirmation__table">
                        <thead>
                            <tr>
                                <th>Shop</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Number</th>
                                <th>Menu</th>
                                <th>Price</th>
                                <th>Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $shop->name }}</td>
                                <td id="table-reservation-date">{{ old('reservation_date') ?? '未選択' }}</td>
                                <td id="table-reservation-time">{{ old('reservation_time') ?? '未選択' }}</td>
                                <td id="table-reservation-number">{{ old('number_of_people') ?? '未選択' }}</td>
                                <td id="table-reservation-menu">{{ old('reservation_menu') ?? '未選択' }}</td>
                                <td id="table-reservation-price">未選択</td>
                                <td id="table-payment-method">{{ old('payment_method') ?? '未選択' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            @guest
                <form action="{{ route('login') }}" method="GET">
                    <button class="reservation__button" type="submit">予約する</button>
                </form>
            @endguest
            @auth
                <form action="{{ route('reserve', $shop->id) }}" id="reservation-form" method="POST">
                    @csrf
                    <input type="hidden" name="from" value="{{ request('from') }}">
                    <button class="reservation__button" type="submit">予約する</button>
                </form>
            @endauth
        </div>
    </div>
</main>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dateInput = document.getElementById('reservation-date');
        const calendarIcon = document.querySelector('.input__calendar');

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