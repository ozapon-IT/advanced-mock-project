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
                <a href="{{ route('top.show') }}">&lt;</a>
                <h2>{{ $shop->name }}</h2>
            </div>

            <div class="content__image">
                <img src="{{ asset('storage/' . $shop->image_path) }}" alt="{{ $shop->name .'の店舗画像' }}">
            </div>

            <div class="content__description">
                <p class="description__area">#{{ $shop->area }}</p>
                <p class="description__genre">#{{ $shop->genre }}</p>
                <p class="description__summary">{{ $shop->summary }}</p>
            </div>
        </div>
        <div class="detail__reservation">
            <div class="reservation__form">
                <h2 class="reservation__title">予約</h2>

                <div class="reservation__field">
                    <input class="field__date" type="date" name="reservation_date" value="{{ old('reservation_date') }}" form="reservation-form" id="reservation-date">

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
                                <td>{{ $shop->name }}</td>
                                <td id="table-reservation-date">{{ old('reservation_date') ?? '未選択' }}</td>
                                <td id="table-reservation-time">{{ old('reservation_time') ?? '未選択' }}</td>
                                <td id="table-reservation-number">{{ old('number_of_people') ?? '未選択' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="reservation__button">
                @guest
                    <form action="/login" method="GET">
                        <button type="submit">予約する</button>
                    </form>
                @endguest

                @auth
                    <form action="{{ route('reserve', $shop->id) }}" id="reservation-form" method="POST">
                        @csrf

                        <button type="submit">予約する</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script>
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