@extends('layouts.representative')

@section('title', '予約詳細ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/representative/reservation-detail.css') }}">
@endsection

@section('main')
<main>
    <div class="reservation-detail">
        <h1 class="reservation-detail__heading">予約詳細</h1>

        <div class="reservation-detail__wrapper">
            <x-reservation-details-table :reservation="$reservation" type="reservation-detail" />

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