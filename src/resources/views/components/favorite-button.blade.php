@if($type === 'index')
    <button
        class="shop-list__favorite js-favorite-button"
        aria-label="{{ $ariaLabel }}"
        data-shop-id="{{ $shop->id }}"
        data-favorited="{{ $isFavorited ? 'true' : 'false' }}"
    >
        <i class="bi bi-suit-heart-fill {{ $isFavorited ? 'bi-suit-heart-fill--red' : '' }}"></i>
    </button>
@elseif($type === 'favorite')
    <button
        class="shop-list__favorite js-favorite-button"
        data-shop-id="{{ $shop->id }}"
        data-favorited="true"
        data-target-id="{{ $cardId }}"
    >
        <i class="bi bi-suit-heart-fill bi-suit-heart-fill--red"></i>
    </button>
@elseif($type === 'visited')
    <button
        class="shop-list__favorite js-favorite-button"
        data-shop-id="{{ $shop->id }}"
        data-favorited="{{ $isFavorited ? 'true' : 'false' }}"
        data-target-id="{{ $cardId }}"
    >
        <i class="bi bi-suit-heart-fill {{ $isFavorited ? 'bi-suit-heart-fill--red' : '' }}"></i>
    </button>
@endif