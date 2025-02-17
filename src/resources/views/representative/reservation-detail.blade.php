@extends('layouts.representative')

@section('title', '予約詳細ページ(店舗代表者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative/reservation-detail.css') }}">
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
    <div class="reservation-detail">
        <h1 class="reservation-detail__heading">予約詳細</h1>
        <div class="reservation-detail__wrapper">
            <table class="reservation-detail__table">
                <thead>
                    <tr class="reservation-detail__table-row">
                        <th>User</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Number</th>
                        <th>Menu</th>
                        <th>Price</th>
                        <th>Payment</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="reservation-detail__table-row">
                        <td>{{ $reservation->user->name }}</td>
                        <td>{{ $reservation->reservation_date }}</td>
                        <td>{{ $reservation->reservation_time }}</td>
                        <td>{{ $reservation->number_of_people }}</td>
                        <td>{{ $reservation->menu->name }}</td>
                        <td>{{ formattedTotalAmount($reservation->total_amount) }}</td>
                        <td>{{ $reservation->payment_method }} {{ $reservation->payment_status === 'paid' ? '決済済み' : '未決済' }}</td>
                    </tr>
                </tbody>
            </table>
            <form action="{{ route('representative.reservations.update', $reservation) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="来店済み">
                <button class="reservation-detail__button" type="submit">来店</button>
            </form>
        </div>
        <div class="reservation-detail__back">
            <a class="reservation-detail__link" href="{{ route('representative.reservations.index') }}">戻る</a>
        </div>
    </div>
</main>
@endsection