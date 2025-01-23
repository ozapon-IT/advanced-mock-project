<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['name' => '和食'],
            ['name' => '洋食'],
            ['name' => '中華'],
            ['name' => 'イタリアン'],
            ['name' => 'フレンチ'],
            ['name' => '焼肉'],
            ['name' => '居酒屋'],
            ['name' => 'ラーメン'],
            ['name' => 'カフェ'],
            ['name' => 'スイーツ'],
            ['name' => 'バー'],
            ['name' => 'ファーストフード'],
            ['name' => 'ベーカリー'],
            ['name' => '海鮮料理'],
            ['name' => 'ビュッフェ'],
            ['name' => 'エスニック料理'],
            ['name' => '寿司'],
            ['name' => '鍋料理'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
