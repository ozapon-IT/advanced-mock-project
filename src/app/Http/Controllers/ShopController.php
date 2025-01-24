<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShopRequest;
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

    public function showShopEditPage()
    {
        $shop = Shop::where('user_id', auth()->id())->first();
        $areas = Area::all();
        $genres = Genre::all();

        return view('representative.shop-edit', compact('shop','areas', 'genres'));
    }

    public function create(ShopRequest $shopRequest)
    {
        $validatedData = $shopRequest->validated();

        $path = $shopRequest->file('image')->store('shops', 'public');

        Shop::create([
            'user_id' => auth()->id(),
            'area_id' => $validatedData['area'],
            'genre_id' => $validatedData['genre'],
            'name' => $validatedData['name'],
            'summary' => $validatedData['summary'],
            'image_path' => $path,
        ]);

        return redirect()->route('representative.dashboard');
    }

    public function update(ShopRequest $shopRequest, Shop $shop)
    {
        $validatedData = $shopRequest->validated();

        if ($shop->image_path) {
            \Storage::disk('public')->delete($shop->image_path);
        }

        $path = $shopRequest->file('image')->store('shops', 'public');


        $shop->update([
            'area_id' => $validatedData['area'],
            'genre_id' => $validatedData['genre'],
            'name' => $validatedData['name'],
            'summary' => $validatedData['summary'],
            'image_path' => $path,
        ]);

        return redirect()->route('representative.dashboard');
    }
}
