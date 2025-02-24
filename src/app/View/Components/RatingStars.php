<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RatingStars extends Component
{
    public $rating;
    public $maxStars;
    public $fullStars;
    public $halfStar;
    public $emptyStars;
    public $showValue;

    /**
     * @param float $rating 評価値（例: 3.5）
     * @param int $maxStars 表示する最大星数（通常は5）
     * @param bool|string $showValue 数値表示をする場合は true を渡す（省略時は false）
     */
    public function __construct($rating = 0, $maxStars = 5, $showValue = false)
    {
        $this->rating = $rating;
        $this->maxStars = $maxStars;
        $this->fullStars = floor($rating);
        $this->halfStar = ($rating - $this->fullStars) >= 0.5 ? 1 : 0;
        $this->emptyStars = $maxStars - ($this->fullStars + $this->halfStar);
        $this->showValue = filter_var($showValue, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.rating-stars');
    }
}
