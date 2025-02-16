<?php

namespace App\Http\Controllers;

use App\Models\Shop;

class FavoriteController extends Controller
{
    public function store(Shop $shop)
    {
        if (!$shop->favorites()->where('user_id', auth()->id())->exists()) {
            $shop->favorites()->create([
                'user_id' => auth()->id(),
                'shop_id' => $shop->id,
            ]);
        }

        return response()->json(['message' => 'favorite added'], 200);
    }

    public function destroy(Shop $shop)
    {
        if ($shop->favorites()->where('user_id', auth()->id())->exists()) {
            $shop->favorites()->where('user_id', auth()->id())->delete();
        }

        return response()->json(['message' => 'favorite removed'], 200);
    }
}
