@extends('layouts.representative')

@section('title', '予約一覧ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative/reservation-list.css') }}">
@endsection

@section('main')
<main>
    <div class="reservation-list">
        <h1 class="reservation-list__heading">予約一覧</h1>

        <table class="reservation-list__table">
            <tr class="reservation-list__table-row">
                <th>予約日時</th>
                <th>予約人数</th>
                <th>お名前</th>
                <th>予約詳細</th>
            </tr>
            @foreach ($reservations as $reservation)
                <tr class="reservation-list__table-row">
                    <td>{{ $reservation->reservation_date }} {{ $reservation->reservation_time }}</td>
                    <td>{{ $reservation->number_of_people }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td><a href="{{ route('representative.reservations.show', $reservation) }}">詳細</a></td>
                </tr>
            @endforeach
        </table>
    </div>
</main>
@endsection