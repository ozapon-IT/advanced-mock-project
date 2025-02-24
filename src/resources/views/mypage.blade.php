@extends('layouts.user')

@section('title', 'マイページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('header')
<x-header />
@endsection

@section('main')
<main>
    <div class="mypage">
        <h1 class="mypage__heading">{{ auth()->user()->name }}さん</h1>

        <x-session-message :errors="$errors" />

        <div class="mypage__contents">
            <section class="mypage__reservation-status">
                <h2 class="mypage__subheading">予約状況 ({{ $reservations->count() }})</h2>

                <div class="mypage__reservation-card-container">
                    @foreach ($reservations as $index => $reservation)
                        <x-reservation-card :reservation="$reservation" :index="$index" />
                    @endforeach
                </div>
            </section>

            <section class="mypage__favorite-shop">
                <h2 class="mypage__subheading">
                    お気に入り店舗 <span id="favorite-count">({{ $favorites->count() }})</span>
                </h2>

                <div class="mypage__shop-list">
                    @foreach ($favorites as $favorite)
                        <x-shop-card :shop="$favorite->shop" type="favorite" />
                    @endforeach
                </div>
            </section>

            <section class="mypage__visited-shop">
                <h2 class="mypage__subheading">行ったお店 ({{ $visitedShops->count() }})</h2>

                <div class="mypage__shop-list">
                    @foreach ($visitedShops as $visitedShop)
                        <x-shop-card :shop="$visitedShop->shop" type="visited" />
                    @endforeach
                </div>
            </section>
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
                        const favoriteList = document.querySelector('.mypage__favorite-shop .mypage__shop-list');
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
                    const updatedCount = document.querySelectorAll('.mypage__favorite-shop .mypage__shop-list .shop-list__card').length;
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