<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Favorite;

class MypageController extends Controller
{
    public function showMypage()
    {
        $reservations = Reservation::where('user_id', auth()->id())
            ->where('payment_status', 'paid')
            ->get();

        $favorites = Favorite::where('user_id', auth()->id())->get();

        return view('mypage', compact('reservations', 'favorites'));
    }
}
