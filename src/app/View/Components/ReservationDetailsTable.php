<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReservationDetailsTable extends Component
{
    public $reservation;
    public $shop;
    public $type;

    /**
     * @param mixed $reservation 予約データ（Reservationモデルのインスタンス）
     * @param mixed $shop 店舗データ（Shopモデルのインスタンス）
     * @param string $type 表示タイプ 'default'（mypage 用）
     */
    public function __construct($reservation = null, $shop = null, $type = 'default')
    {
        $this->reservation =$reservation;
        $this->shop =$shop;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reservation-details-table');
    }
}
