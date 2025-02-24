@for ($i = 0; $i < $fullStars; $i++)
    <i class="bi bi-star-fill"></i>
@endfor

@if ($halfStar)
    <i class="bi bi-star-half"></i>
@endif

@for ($i = 0; $i < $emptyStars; $i++)
    <i class="bi bi-star"></i>
@endfor

@if ($showValue)
    <span class="detail__shop-rating-value">{{ number_format($rating, 2) }}</span>
@endif