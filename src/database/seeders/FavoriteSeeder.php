<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Shop;
use App\Models\Favorite;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 1)->get();

        $shops = Shop::all();

        foreach ($users as $user) {
            $randomShops = $shops->random(4);

            foreach ($randomShops as $shop) {
                Favorite::create([
                    'user_id' => $user->id,
                    'shop_id' => $shop->id,
                ]);
            }
        }
    }
}
