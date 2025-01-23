@extends('layouts.representative')

@section('title', '予約一覧ページ(店舗代表者) - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative/reservation-list.css') }}">
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
    <div class="reservation-list">
        <h2 class="reservation-list__title">予約一覧</h2>
        <table class="reservation-list__table">
            <tr class="table__row">
                <th>予約日時</th>
                <th>予約人数</th>
                <th>お名前</th>
                <th>予約詳細</th>
            </tr>
            @foreach ($reservations as $reservation)
                <tr class="table__row">
                    <td>{{ $reservation->reservation_date }} {{ $reservation->reservation_time }}</td>
                    <td>{{ $reservation->number_of_people }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td><a href="{{ route('show.reservation-detail', $reservation) }}">詳細</a></td>
                </tr>
            @endforeach
        </table>
    </div>
</main>
@endsection