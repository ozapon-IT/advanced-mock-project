<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use App\Models\Menu;
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
        $shop = Shop::where('user_id', auth()->id())->first();

        if (!$shop) {
            return view('representative.dashboard', [
                'shopEditDate' => null,
                'menuEditDate' => null,
                'totalReservations' => null,
            ]);
        }

        $shopEditDate = $shop->updated_at->toDateString();

        $totalMenus= Menu::where('shop_id', $shop->id)->count();

        $totalReservations = Reservation::where('shop_id', $shop->id)->where('status', '予約済み')->count();

        return view('representative.dashboard', compact('totalReservations', 'shopEditDate', 'totalMenus'));
    }
}
