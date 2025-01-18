@extends('layouts.app')

@section('title', 'マイページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
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
    <div class="mypage">
        <h2 class="mypage__name">{{ auth()->user()->name }}さん</h2>
        <div class="mypage__content">
            <div class="content__reservation-status">
                <h3 class="reservation-status__title">予約状況</h3>
                <div class="reservation-status__container">
                    @foreach ($reservations as $index => $reservation)
                        <div class="reservation-status__card">
                            <div class="card__number">
                                <i class="bi bi-clock-fill"></i>
                                <p>{{ $index === 0 ? '予約1' : '予約' . ($index + 1) }}</p>
                            </div>
                            <table class="card__table">
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
                                        <td>{{ $reservation->reservation_date }}</td>
                                        <td>{{ $reservation->reservation_time }}</td>
                                        <td>{{ $reservation->number_of_people}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="card__delete-button">
                                <form action="{{ route('delete.reservation', $reservation) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="bi bi-x-circle"></i></button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="content__favorite">
                <h3 class="favorite__title">お気に入り店舗</h3>
                <div class="favorite__shop-list">
                    @foreach ($favorites as $favorite)
                        <div class="shop-list__card" id="favorite-card-{{ $favorite->shop->id }}">
                            <div class="shop-list__image">
                                <img src="{{ asset('storage/' . $favorite->shop->image_path) }}" alt="{{ $favorite->shop->name . 'の店舗画像' }}">
                            </div>
                            <div class="shop-list__content">
                                <h2 class="shop-list__name">{{ $favorite->shop->name }}</h2>
                                <p class="shop-list__area">#{{ $favorite->shop->area }}</p>
                                <p class="shop-list__genre">#{{ $favorite->shop->genre }}</p>
                                <a class="shop-list__detail" href="{{ route('detail.show', $favorite->shop_id) . '?from=mypage' }}">詳しくみる</a>
                                <button
                                    class="shop-list__favorite js-favorite-button"
                                    data-shop-id="{{ $favorite->shop->id }}"
                                    data-favorited="true"
                                    data-target-id="favorite-card-{{ $favorite->shop->id }}"
                                >
                                    <i class="bi bi-suit-heart-fill favorite--addition"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const favoriteButtons = document.querySelectorAll('.js-favorite-button');
        favoriteButtons.forEach(button => {
            button.addEventListener('click', async (e) => {
                e.preventDefault();

                const shopId = button.dataset.shopId;
                const isFavorited = button.dataset.favorited === 'true';
                const targetId =button.dataset.targetId;
                const url = `/favorite/${shopId}`;
                const method = isFavorited ? 'DELETE' : 'POST';

                try {
                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content,
                            'Content_Type' : 'application/json',
                        }
                    });

                    if (response.ok) {
                        if (method === 'DELETE') {
                            const targetCard = document.getElementById(targetId);
                            if (targetCard) {
                                targetCard.remove();
                            }
                        }
                        button.setAttribute('data-favorited', isFavorited ? 'false' : 'true');
                    } else {
                        console.error('お気に入りの更新に失敗しました。');
                    }
                } catch (error) {
                    console.error('通信エラー:', error)
                }
            });
        });
    });
</script>
@endsection