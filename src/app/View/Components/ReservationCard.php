<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReservationCard extends Component
{
    public $reservation;
    public $index;

    /**
     * @param mixed $reservation 予約データ（Reservationモデルのインスタンス）
     * @param int $index ループ中のインデックス
     */
    public function __construct($reservation, $index)
    {
        $this->reservation = $reservation;
        $this->index = $index;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reservation-card');
    }
}
