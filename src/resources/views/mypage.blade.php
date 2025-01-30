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
                                        <th>Menu</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $reservation->shop->name }}</td>
                                        <td>{{ $reservation->reservation_date }}</td>
                                        <td>{{ $reservation->reservation_time }}</td>
                                        <td>{{ $reservation->number_of_people}}</td>
                                        <td>{{ $reservation->menu->name}}</td>
                                        <td>{{ formattedTotalAmount($reservation->total_amount) }}</td>
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
                            <div class="card__reservation-change">
                                <form action="{{ route('change.reservation', $reservation) }}" method="GET">
                                    <button type="submit">予約変更</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="content__favorite">
                <h3 class="favorite__title">お気に入り店舗</h3>
                <div class="shop-list">
                    @foreach ($favorites as $favorite)
                        <div class="shop-list__card" id="favorite-card-{{ $favorite->shop->id }}">
                            <div class="shop-list__image">
                                <img src="{{ asset('storage/' . $favorite->shop->image_path) }}" alt="{{ $favorite->shop->name . 'の店舗画像' }}">
                            </div>
                            <div class="shop-list__content">
                                <h2 class="shop-list__name">{{ $favorite->shop->name }}</h2>
                                <p class="shop-list__area">#{{ $favorite->shop->area->name }}</p>
                                <p class="shop-list__genre">#{{ $favorite->shop->genre->name }}</p>
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

            <div class="mypage__visited">
                <h3 class="mypage__subtitle">行ったお店</h3>

                <div class="shop-list">
                    @foreach ($visitedShops as $visitedShop)
                        <div class="shop-list__card" id="visited-card-{{ $visitedShop->shop->id }}">
                            <div class="shop-list__image">
                                <img src="{{ asset('storage/' . $visitedShop->shop->image_path) }}" alt="{{ $visitedShop->shop->name . 'の店舗画像' }}">
                            </div>
                            <div class="shop-list__content">
                                <h2 class="shop-list__name">{{ $visitedShop->shop->name }}</h2>
                                <p class="shop-list__area">#{{ $visitedShop->shop->area->name }}</p>
                                <p class="shop-list__genre">#{{ $visitedShop->shop->genre->name }}</p>
                                <a class="shop-list__detail" href="{{ route('show.review', $visitedShop->shop->id) . '?from=mypage' }}">レビューする</a>
                                <button
                                    class="shop-list__favorite js-favorite-button"
                                    data-shop-id="{{ $visitedShop->shop->id }}"
                                    data-favorited="{{ $visitedShop->shop->favorites->contains('user_id', auth()->id()) ? 'true' : 'false' }}"
                                    data-target-id="visited-card-{{ $visitedShop->shop->id }}"
                                >
                                    <i
                                        class="bi bi-suit-heart-fill {{ $visitedShop->shop->favorites->contains('user_id', auth()->id()) ? 'favorite--addition' : '' }}">
                                    </i>
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
        document.addEventListener('click', async (e) => {
            const button = e.target.closest('.js-favorite-button');
            if (!button) return; // クリック対象がボタンでなければ無視

            e.preventDefault();

            const shopId = button.dataset.shopId;
            const isFavorited = button.dataset.favorited === 'true';
            const url = `/favorite/${shopId}`;
            const method = isFavorited ? 'DELETE' : 'POST';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type' : 'application/json',
                    }
                });

                if (response.ok) {
                    // 同じ shopId のボタンを全て取得して連動更新
                    const allRelatedButtons = document.querySelectorAll(`.js-favorite-button[data-shop-id=\"${shopId}\"]`);

                    allRelatedButtons.forEach((btn) => {
                        const currentFavorited = btn.dataset.favorited === 'true';
                         // dataset を反転
                        btn.dataset.favorited = currentFavorited ? 'false' : 'true';
                        // アイコンのクラス付け外し
                        const icon = btn.querySelector('i');
                        if (icon) {
                            icon.classList.toggle('favorite--addition', !currentFavorited);
                        }

                        // お気に入り解除(DELETE) の場合、お気に入り一覧カードは削除
                        if (method === 'DELETE') {
                            const targetId = btn.dataset.targetId;
                            if (targetId && targetId.includes('favorite-card')) {
                                const targetCard = document.getElementById(targetId);
                                if (targetCard) {
                                    targetCard.remove();
                                }
                            }
                        }
                    });

                    // お気に入り追加時、新しいカードをお気に入り店舗リストに追加
                    if (method === 'POST') {
                         // 「行ったお店」リストから同じ shopId を持つカードを取得
                        const favoriteList = document.querySelector('.content__favorite .shop-list');
                        // すでに追加されていないか確認（重複防止）
                        if (!document.getElementById(`favorite-card-${shopId}`)) {
                            const visitedCard = document.getElementById(`visited-card-${shopId}`);
                            if (visitedCard) {
                                // カードをクローン（複製）
                                const newCard = visitedCard.cloneNode(true);
                                newCard.id = `favorite-card-${shopId}`;
                                // ボタンの設定を変更
                                const newButton = newCard.querySelector('.js-favorite-button');
                                newButton.dataset.targetId = `favorite-card-${shopId}`;
                                newButton.dataset.favorited = "true";
                                // アイコンを正しく反映
                                const newIcon = newButton.querySelector('i');
                                newIcon.classList.add('favorite--addition');
                                // お気に入りリストに追加
                                favoriteList.appendChild(newCard);
                            }
                        }
                    }
                } else {
                    console.error('お気に入りの更新に失敗しました。');
                }
            } catch (error) {
                console.error('通信エラー:', error)
            }
        });
    });
</script>
@endsection