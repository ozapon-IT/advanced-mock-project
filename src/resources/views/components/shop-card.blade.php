<div class="shop-list__card" @if($cardId) id="{{ $cardId }}" @endif>
    <div class="shop-list__image">
        <img src="{{ Storage::disk('s3')->url($shop->image_path) }}" alt="{{ $shop->name . 'の店舗画像' }}">
    </div>

    <div class="shop-list__content">
        <h2 class="shop-list__name">{{ mb_strimwidth($shop->name, 0, 15, '...') }}</h2>

        <p class="shop-list__area">#{{ $shop->area->name }}</p>

        <p class="shop-list__genre">#{{ $shop->genre->name }}</p>

        {{-- 詳細リンクの切り替え --}}
        @if ($type === 'index')
            <a class="shop-list__detail" href="{{ route('detail.show', $shop->id) . '?from=top' }}" aria-label="{{ $shop->name }}の詳細を見る">詳しくみる</a>
        @elseif ($type === 'favorite')
            <a class="shop-list__detail" href="{{ route('detail.show', $shop->id) . '?from=mypage' }}" aria-label="{{ $shop->name }}の詳細を見る">詳しくみる</a>
        @elseif ($type === 'visited')
            <a class="shop-list__detail" href="{{ route('reviews.create', $shop->id) . '?from=mypage' }}" aria-label="{{ $shop->name }}の詳細を見る">レビューする</a>
        @endif

        {{-- お気に入りボタンの表示 --}}
        @if ($type === 'index')
            @guest
                <a class="shop-list__favorite" href="{{ route('login') }}">
                    <i class="bi bi-suit-heart-fill"></i>
                </a>
            @endguest

            @auth
                @if (auth()->user()->isUser())
                <x-favorite-button :shop="$shop" type="index" />
                @endif
            @endauth
        @elseif ($type === 'favorite')
            <x-favorite-button :shop="$shop" type="favorite" :cardId="$cardId" />
        @elseif ($type === 'visited')
            <x-favorite-button :shop="$shop" type="visited" :cardId="$cardId" />
        @endif

        {{-- 評価表示 --}}
        <div class="shop-list__rating">
            <x-rating-stars :rating="$shop->average_rating" />
        </div>
    </div>
</div>
