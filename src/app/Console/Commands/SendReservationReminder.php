<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationReminderMail;
use App\Mail\RepresentativeReminderMail;
use App\Models\Reservation;
use Carbon\Carbon;

class SendReservationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reservation-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails for today\'s reservations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today()->toDateString();

        $reservations = Reservation::where('reservation_date', $today)->get();

        // 一般ユーザーへリマインダー送信
        foreach ($reservations as $reservation) {
            Mail::to($reservation->user->email)->send(new ReservationReminderMail($reservation));
        }

        $groupedByShop = $reservations->groupBy('shop_id');

        // 店舗代表者に当日予約情報リストを送信
        foreach ($groupedByShop as $shopId => $reservationsForShop) {
            $shop = $reservationsForShop->first()->shop;
            $representativeEmail = $shop->user->email;

            Mail::to($representativeEmail)->send(new RepresentativeReminderMail($shop, $reservationsForShop));
        }

        $this->info('Reservation reminder emails sent successfully');
    }
}
