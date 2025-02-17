@extends('layouts.user')

@section('title', 'マイページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
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
    <div class="mypage">
        <h1 class="mypage__heading">{{ auth()->user()->name }}さん</h1>

        @if ($errors->has('error'))
            <div class="message message--alert">
                <span>{{ $errors->first('error') }}</span>
            </div>
        @elseif (session('success'))
            <div class="message">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="mypage__contents">
            <section class="mypage__reservation-status">
                <h2 class="mypage__subheading">予約状況 ({{ $reservations->count() }})</h2>
                <div class="mypage__reservation-card-container">
                    @foreach ($reservations as $index => $reservation)
                        <div class="mypage__reservation-card">
                            <div class="mypage__reservation-card-header">
                                <i class="bi bi-clock-fill"></i>
                                <p>{{ $index === 0 ? '予約1' : '予約' . ($index + 1) }}</p>
                            </div>
                            <table class="mypage__reservation-card-table">
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
                            <div class="mypage__reservation-delete">
                                <form action="{{ route('reservations.destroy', $reservation) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="mypage__button" type="submit"><i class="bi bi-x-circle"></i></button>
                                </form>
                            </div>
                            <div class="mypage__reservation-change">
                                <form action="{{ route('reservations.edit', $reservation) }}" method="GET">
                                    <button class="mypage__button mypage__button--update" type="submit">予約変更</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            <div class="mypage__favorite-shop">
                <h2 class="mypage__subheading">
                    お気に入り店舗 <span id="favorite-count">({{ $favorites->count() }})</span>
                </h2>
                <div class="shop-list">
                    @foreach ($favorites as $favorite)
                        <div class="shop-list__card" id="favorite-card-{{ $favorite->shop->id }}">
                            <div class="shop-list__image">
                                <img src="{{ asset('storage/' . $favorite->shop->image_path) }}" alt="{{ $favorite->shop->name . 'の店舗画像' }}">
                            </div>
                            <div class="shop-list__content">
                                <h2 class="shop-list__name">{{ mb_strimwidth($favorite->shop->name, 0, 15, "...") }}</h2>
                                <p class="shop-list__area">#{{ $favorite->shop->area->name }}</p>
                                <p class="shop-list__genre">#{{ $favorite->shop->genre->name }}</p>
                                <a class="shop-list__detail" href="{{ route('detail.show', $favorite->shop_id) . '?from=mypage' }}" aria-label="{{ $favorite->shop->name }}の詳細を見る">詳しくみる</a>
                                <button
                                    class="shop-list__favorite js-favorite-button"
                                    data-shop-id="{{ $favorite->shop->id }}"
                                    data-favorited="true"
                                    data-target-id="favorite-card-{{ $favorite->shop->id }}"
                                >
                                    <i class="bi bi-suit-heart-fill bi-suit-heart-fill--red"></i>
                                </button>
                                <div class="shop-list__rating">
                                    @php
                                        $averageRating = $favorite->average_rating ?? 0;
                                        $fullStars = floor($averageRating);
                                        $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                                        $emptyStars = 5 - ($fullStars + $halfStar);
                                    @endphp

                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <i class="bi bi-star-fill"></i>
                                    @endfor

                                    @if ($halfStar)
                                        <i class="bi bi-star-half"></i>
                                    @endif

                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class="bi bi-star"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mypage__visited-shop">
                <h2 class="mypage__subheading">行ったお店 ({{ $visitedShops->count() }})</h2>

                <div class="shop-list">
                    @foreach ($visitedShops as $visitedShop)
                        <div class="shop-list__card" id="visited-card-{{ $visitedShop->shop->id }}">
                            <div class="shop-list__image">
                                <img src="{{ asset('storage/' . $visitedShop->shop->image_path) }}" alt="{{ $visitedShop->shop->name . 'の店舗画像' }}">
                            </div>
                            <div class="shop-list__content">
                                <h2 class="shop-list__name">{{ mb_strimwidth($visitedShop->shop->name, 0, 15, "...") }}</h2>
                                <p class="shop-list__area">#{{ $visitedShop->shop->area->name }}</p>
                                <p class="shop-list__genre">#{{ $visitedShop->shop->genre->name }}</p>
                                <a class="shop-list__detail" href="{{ route('reviews.create', $visitedShop->shop->id) . '?from=mypage' }}" aria-label="{{ $visitedShop->shop->name }}の詳細を見る">レビューする</a>
                                <button
                                    class="shop-list__favorite js-favorite-button"
                                    data-shop-id="{{ $visitedShop->shop->id }}"
                                    data-favorited="{{ $visitedShop->shop->favorites->contains('user_id', auth()->id()) ? 'true' : 'false' }}"
                                    data-target-id="visited-card-{{ $visitedShop->shop->id }}"
                                >
                                    <i
                                        class="bi bi-suit-heart-fill {{ $visitedShop->shop->favorites->contains('user_id', auth()->id()) ? 'bi-suit-heart-fill--red' : '' }}">
                                    </i>
                                </button>
                                <div class="shop-list__rating">
                                    @php
                                        $averageRating = $visitedShop->average_rating ?? 0;
                                        $fullStars = floor($averageRating);
                                        $halfStar = ($averageRating - $fullStars) >= 0.5 ? 1 : 0;
                                        $emptyStars = 5 - ($fullStars + $halfStar);
                                    @endphp

                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <i class="bi bi-star-fill"></i>
                                    @endfor

                                    @if ($halfStar)
                                        <i class="bi bi-star-half"></i>
                                    @endif

                                    @for ($i = 0; $i < $emptyStars; $i++)
                                        <i class="bi bi-star"></i>
                                    @endfor
                                </div>
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
                            icon.classList.toggle('bi-suit-heart-fill--red', !currentFavorited);
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
                        const favoriteList = document.querySelector('.mypage__favorite-shop .shop-list');
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
                                newIcon.classList.add('bi-suit-heart-fill--red');
                                // 詳しくみるページ用のリンクに書き換え
                                const detailLink = newCard.querySelector('.shop-list__detail');
                                if (detailLink) {
                                    detailLink.href = `/detail/${shopId}?from=mypage`;
                                    detailLink.textContent = '詳しくみる';
                                }
                                // お気に入りリストに追加
                                favoriteList.appendChild(newCard);
                            }
                        }
                    }

                    // お気に入り店舗数更新
                    const updatedCount = document.querySelectorAll('.mypage__favorite-shop .shop-list .shop-list__card').length;
                    const favoriteCountElement = document.getElementById('favorite-count');
                    favoriteCountElement.textContent = `(${updatedCount})`;
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