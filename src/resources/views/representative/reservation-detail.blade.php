@extends('layouts.representative')

@section('title', '予約詳細ページ(店舗代表者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative/reservation-detail.css') }}">
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
    <div class="reservation-detail">
        <h2 class="reservation-detail__title">予約詳細</h2>
        <table class="reservation-detail__table">
            <thead>
                <tr class="table__row">
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
                <tr class="table__row">
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
    </div>
</main>
@endsection