@extends('layouts.user')

@section('title', '予約変更ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation-change.css') }}">
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
    <div class="reservation-change">
        <h1 class="reservation-change__heading">予約変更</h1>

        <div class="reservation-change__form">
            <div class="reservation-change__input-field">
                <input class="reservation-change__input" type="text" name="reservation_date" value="{{ old('reservation_date') }}" form="reservation-form" id="reservation-date" placeholder="予約日">

                <button  class="reservation-change__button reservation-change__button--calendar" type="button">
                    <i class="bi bi-calendar"></i>
                </button>
            </div>

            @error('reservation_date')
                <span class="error-message error-message--yellow">{{ $message }}</span>
            @enderror
            <div class="reservation-change__select-field">
                <select class="reservation-change__select" name="reservation_time" form="reservation-form" id="reservation-time">
                    <option value="" disabled {{ old('reservation_time') ? '' : 'selected'}}>予約時間</option>

                    @foreach (generateReservationTimes() as $time)
                        <option value="{{ $time }}" {{ old('reservation_time') == $time ? 'selected' : ''}}>{{ $time }}</option>
                    @endforeach
                </select>
            </div>

            @error('reservation_time')
                <span class="error-message error-message--yellow">{{ $message }}</span>
            @enderror

            <div class="reservation-change__select-field">
                <select class="reservation-change__select" name="number_of_people" form="reservation-form" id="reservation-number">
                    <option value="" disabled {{ old('number_of_people') ? '' : 'selected'}}>予約人数</option>

                    @foreach (generateReservationNumbers() as $number)
                        <option value="{{ $number }}" {{ old('number_of_people') == $number ? 'selected' : ''}}>{{ $number }}</option>
                    @endforeach
                </select>
            </div>

            @error('number_of_people')
                <span class="error-message error-message--yellow">{{ $message }}</span>
            @enderror

            <div class="reservation-change__select-field">
                <select class="reservation-change__select" name="reservation_menu" form="reservation-form" id="reservation-menu">
                    <option value="" disabled {{ old('menu') ? '' : 'selected'}}>予約メニュー</option>

                    @foreach (generateReservationMenus($reservation->shop->id) as $menu)
                        <option value="{{ $menu }}" {{ old('menu') == $menu ? 'selected' : ''}}>{{ $menu }}</option>
                    @endforeach
                </select>
            </div>

            @error('reservation_menu')
                <span class="error-message error-message--yellow">{{ $message }}</span>
            @enderror
        </div>

        <div class="reservation-change__confirmation">
            <table class="reservation-change__confirmation-table">
                <thead>
                    <tr>
                        <th>Shop</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Number</th>
                        <th>Menu</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $reservation->shop->name }}</td>

                        <td id="table-reservation-date">{{ old('reservation_date') ?? $reservation->reservation_date }}</td>

                        <td id="table-reservation-time">{{ old('reservation_time') ?? $reservation->reservation_time }}</td>

                        <td id="table-reservation-number">{{ old('number_of_people') ?? $reservation->number_of_people }}</td>

                        <td id="table-reservation-menu">{{ old('reservation_menu') ?? $reservation->menu->name }}</td>

                        <td id="table-reservation-price">{{ formattedTotalAmount($reservation->total_amount) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <form action="{{ route('reservations.update', $reservation) }}" id="reservation-form" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="payment_method" value="{{ $reservation->payment_method }}">

            <button class="reservation-change__button reservation-change__button--update" type="submit">予約変更する</button>
        </form>
    </div>

    <div class="reservation-change__back">
        <a class="reservation-change__back-link" href="{{ route('mypage.index') }}">戻る</a>
    </div>
</main>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dateInput = document.getElementById('reservation-date');
        const calendarIcon = document.querySelector('.reservation-change__button--calendar');

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

        const tableDate = document.getElementById('table-reservation-date');
        const tableTime = document.getElementById('table-reservation-time');
        const tableNumber = document.getElementById('table-reservation-number');
        const tableMenu = document.getElementById('table-reservation-menu');

        dateInput.addEventListener('change', () => {
            tableDate.textContent = dateInput.value || '';
        });

        timeSelect.addEventListener('change', () => {
            tableTime.textContent = timeSelect.value || '';
        });

        numberSelect.addEventListener('change', () => {
            tableNumber.textContent = numberSelect.value || '';
        });

        menuSelect.addEventListener('change', () => {
            tableMenu.textContent = menuSelect.value || '';
        });

        const tablePrice = document.getElementById('table-reservation-price');

        const shopId = {{ $reservation->shop->id }};

        const updatePrice = async () => {
            const numberOfPeople = parseInt(numberSelect.value || 0);
            const menuName = menuSelect.value || '';

            if (!numberOfPeople || !menuName) {
                tablePrice.textContent = '';
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