<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shops = Shop::all();

        foreach ($shops as $shop) {
            $menus = [
                ['name' => 'Aメニュー', 'price' => 2000],
                ['name' => 'Bメニュー', 'price' => 3000],
                ['name' => 'Cメニュー', 'price' => 4000],
            ];

            foreach ($menus as $menu) {
                Menu::create([
                    'shop_id' => $shop->id,
                    'name' => $menu['name'],
                    'price' => $menu['price'],
                ]);
            }
        }
    }
}
