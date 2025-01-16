<?php

namespace App\Http\Controllers;

use App\Models\Shop;

class FavoriteController extends Controller
{
    public function add(Shop $shop)
    {
        if (!$shop->favorites()->where('user_id', auth()->id())->exists()) {
            $shop->favorites()->create([
                'user_id' => auth()->id(),
                'shop_id' => $shop->id,
            ]);
        }

        return redirect()->back();
    }

    public function delete(Shop $shop)
    {
        if ($shop->favorites()->where('user_id', auth()->id())->exists()) {
            $shop->favorites()->where('user_id', auth()->id())->delete();
        }

        return redirect()->back();
    }
}
