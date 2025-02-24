<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FavoriteButton extends Component
{
    public $shop;
    public $type;
    public $cardId;
    public $isFavorited;
    public $ariaLabel;

    /**
     * @param mixed $shop 対象の店舗モデル
     * @param string $type 表示タイプ："index" | "favorite" | "visited"
     * @param string|null $cardId typeが"favorite"または"visited"の場合のカード固有ID
     */
    public function __construct($shop, $type ='index', $cardId = null)
    {
        $this->shop = $shop;
        $this->type = $type;
        $this->cardId = $cardId;

        if ($type === 'favorite') {
            $this->isFavorited = true;
        } else {
            $this->isFavorited = $shop->favorites->contains('user_id', auth()->id());
        }

        if ($type === 'index') {
            $this->ariaLabel = $this->isFavorited ? 'お気に入りを解除' : 'お気に入りを追加';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.favorite-button');
    }
}
