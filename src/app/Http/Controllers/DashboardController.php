<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function adminIndex()
    {
        $totalUsers = User::where('role', 1)->count();

        $totalRepresentatives = User::where('role', 2)->count();

        return view('admin.dashboard', compact('totalUsers', 'totalRepresentatives'));
    }

    public function representativeIndex()
    {
        $shopId = Shop::where('user_id', auth()->id())->first()->id;

        $totalReservations = Reservation::where('shop_id', $shopId)->count();

        return view('representative.dashboard', compact('totalReservations'));
    }
}
