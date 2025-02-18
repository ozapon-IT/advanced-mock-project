@extends('layouts.user')

@section('title', '飲食店一覧ページ - Rese')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('header')
<x-header :showSearch="true" :areas="$areas" :genres="$genres" />
@endsection

@section('main')
<main>
    <div class="shop-list">
        @foreach ($shops as $shop)
            <x-shop-card :shop="$shop" type="index" />
        @endforeach
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

                const shopId = button.getAttribute('data-shop-id');
                const isFavorited = button.getAttribute('data-favorited') === 'true';

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
                        button.setAttribute('data-favorited', isFavorited ? 'false' : 'true');

                        const icon = button.querySelector('i');
                        icon.classList.toggle('bi-suit-heart-fill--red');
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