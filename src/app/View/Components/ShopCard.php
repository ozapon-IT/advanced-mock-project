<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShopCard extends Component
{
    public $shop;
    public $type;
    public $cardId;

    /**
     * @param mixed $shop 対象の店舗モデル（indexページの場合は $shop、マイページの場合は $favorite->shop や $visitedShop->shop）
     * @param string $type 表示タイプ（"index", "favorite", "visited"）
     */
    public function __construct($shop, $type = 'index')
    {
        $this->shop = $shop;
        $this->type = $type;

        // favorite と visited の場合はカードに固有のIDを付与（JS連動用）
        if ($type === 'favorite') {
            $this->cardId = 'favorite-card-' . $shop->id;
        } elseif ($type === 'visited') {
            $this->cardId = 'visited-card-' . $shop->id;
        } else {
            $this->cardId = null;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.shop-card');
    }
}
