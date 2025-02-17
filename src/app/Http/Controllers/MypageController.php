<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Favorite;

class MypageController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('user_id', auth()->id())
            ->where('status', '予約済み')
            ->get();

        $favorites = Favorite::with(['shop'])
            ->where('user_id', auth()->id())
            ->get()
            ->map(function ($favorite) {
                $favorite->average_rating = round($favorite->shop->reviews->avg('rating'), 2);
                return $favorite;
            });


        $visitedShops = Reservation::with(['shop'])
            ->where('user_id', auth()->id())
            ->where('status', '来店済み')
            ->get()
            ->unique('shop_id')
            ->map(function ($visitedShop) {
                $visitedShop->average_rating = round($visitedShop->shop->reviews->avg('rating'), 2);
                return $visitedShop;
            });

        return view('mypage', compact('reservations', 'favorites', 'visitedShops'));
    }
}
