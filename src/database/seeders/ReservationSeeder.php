<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Shop;
use App\Models\Reservation;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 1)->get();
        $shops = Shop::with('menus')->get();
        $possibleTimes = ['18:00', '19:00', '20:00', '21:00'];

        foreach ($users as $user) {
            for ($i = 0; $i < 2; $i++) {
                $shop = $shops->random();

                if ($shop->menus->isEmpty()) {
                    continue;
                }

                $menu = $shop->menus->random();

                $reservationDate = Carbon::now()->addDays(rand(1, 30))->format('Y-m-d');
                $reservationTime = $possibleTimes[array_rand($possibleTimes)];
                $numberOfPeople = rand(1,5);
                $totalAmount = $menu->price * $numberOfPeople;

                Reservation::create([
                    'user_id' => $user->id,
                    'shop_id' => $shop->id,
                    'menu_id' => $menu->id,
                    'reservation_date' => $reservationDate,
                    'reservation_time' => $reservationTime,
                    'number_of_people' => $numberOfPeople . '人',
                    'total_amount' => $totalAmount,
                    'payment_method' => 'カード払い',
                    'payment_status' => 'paid',
                ]);
            }
        }
    }
}
