@extends('layouts.app')

@section('title', '予約変更ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation-change.css') }}">
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
    <div class="change__reservation">
        <div class="reservation__form">
            <h2 class="reservation__title">予約変更</h2>
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
            </div>
            <div class="reservation__confirmation">
                <table class="confirmation__table">
                    <thead>
                        <tr>
                            <th>Shop</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $reservation->shop->name }}</td>
                            <td id="table-reservation-date">{{ old('reservation_date') ?? $reservation->reservation_date }}</td>
                            <td id="table-reservation-time">{{ old('reservation_time') ?? $reservation->reservation_time }}</td>
                            <td id="table-reservation-number">{{ old('number_of_people') ?? $reservation->number_of_people }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <form action="{{ route('change.reservation', $reservation) }}" id="reservation-form" method="POST">
            @csrf
            @method('PATCH')
            <button class="reservation__button" type="submit">予約変更する</button>
        </form>
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

        const tableDate = document.getElementById('table-reservation-date');
        const tableTime = document.getElementById('table-reservation-time');
        const tableNumber = document.getElementById('table-reservation-number');

        dateInput.addEventListener('change', () => {
            tableDate.textContent = dateInput.value || '未選択';
        });

        timeSelect.addEventListener('change', () => {
            tableTime.textContent = timeSelect.value || '未選択';
        });

        numberSelect.addEventListener('change', () => {
            tableNumber.textContent = numberSelect.value || '未選択';
        });
    });
</script>
@endsection