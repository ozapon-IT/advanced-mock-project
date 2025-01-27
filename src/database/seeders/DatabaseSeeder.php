<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AreaSeeder::class,
            GenreSeeder::class,
            ShopSeeder::class,
            MenuSeeder::class,
            FavoriteSeeder::class,
            ReservationSeeder::class,
        ]);

        \App\Models\Announce::factory(20)->create();
    }
}
