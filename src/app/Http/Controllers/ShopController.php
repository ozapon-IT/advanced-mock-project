<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Menu;

class ShopController extends Controller
{
    public function showTopPage(Request $request)
    {
        $shops = Shop::query()
            ->filterByArea($request->area)
            ->filterByGenre($request->genre)
            ->filterByText($request->text)
            ->get();

        $areas = Area::all();
        $genres = Genre::all();

        return view('index', compact('shops', 'areas', 'genres'));
    }

    public function showDetailPage(int $id)
    {
        $shop = Shop::find($id);

        if (!$shop) {
            abort(404, 'Shop not found');
        }

        $menus = Menu::where('shop_id', $id)->get();

        return view('detail' , compact('shop', 'menus'));
    }
}
