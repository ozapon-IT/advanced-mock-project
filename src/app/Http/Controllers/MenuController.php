<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;
use App\Models\Shop;
use App\Models\Menu;

class MenuController extends Controller
{
    public function edit()
    {
        $shopId = Shop::where('user_id', auth()->id())->first()->id;
        $menus = Menu::where('shop_id', $shopId)->get();

        return view('representative.menu-edit', compact('menus'));
    }

    public function store(MenuRequest $request)
    {
        $validatedData = $request->validated();

        $shopId = Shop::where('user_id', auth()->id())->first()->id;

        Menu::create([
            'shop_id' => $shopId,
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
        ]);

        return redirect()->route('representative.dashboard')->with(['success' => 'メニューを作成しました。']);
    }

    public function update(MenuRequest $request, Menu $menu)
    {
        $validatedData = $request->validated();

        $menu->update([
            'name' => $validatedData['name_' . $menu->id],
            'price' => $validatedData['price_' . $menu->id],
        ]);

        return redirect()->route('representative.dashboard')->with(['success' => 'メニューを更新しました。']);
    }
}
