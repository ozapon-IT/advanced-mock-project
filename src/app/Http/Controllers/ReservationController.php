<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Menu;
use App\Models\Shop;

class ReservationController extends Controller
{
    public function reserve(int $id, ReservationRequest $reservationRequest)
    {
        $totalAmount = calculateTotalAmount((int)$reservationRequest->number_of_people, $reservationRequest->reservation_menu, $id);

        $paymentMethod = $reservationRequest->payment_method;

        $menuId = Menu::where('shop_id', $id)->where('name', $reservationRequest->reservation_menu)->first()->id;

        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'shop_id' => $id,
            'menu_id' => $menuId,
            'reservation_date' => $reservationRequest->reservation_date,
            'reservation_time' => $reservationRequest->reservation_time,
            'number_of_people' => $reservationRequest->number_of_people,
            'payment_method' => $paymentMethod,
            'total_amount' => $totalAmount,
        ]);

        $from = $reservationRequest->input('from');

        return redirect()->route('create.checkout-session', ['amount' => $totalAmount, 'reservation_id' => $reservation->id, 'from' => $from]);
    }

    public function done()
    {
        return view('done');
    }

    public function deleteReservation(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('show.mypage');
    }

    public function show(Reservation $reservation)
    {
        return view('reservation-change', compact('reservation'));
    }

    public function changeReservation(Reservation $reservation, ReservationRequest $reservationRequest)
    {
        $shopId = $reservation->shop->id;

        $totalAmount = calculateTotalAmount((int)$reservationRequest->number_of_people, $reservationRequest->reservation_menu, $shopId);

        $menuId = Menu::where('shop_id', $shopId)->where('name', $reservationRequest->reservation_menu)->first()->id;

        $reservation->update([
            'menu_id' => $menuId,
            'reservation_date' => $reservationRequest->reservation_date,
            'reservation_time' => $reservationRequest->reservation_time,
            'number_of_people' => $reservationRequest->number_of_people,
            'total_amount' => $totalAmount,
        ]);

        return redirect()->route('show.mypage');
    }

    public function showReservationListPage()
    {
        $shopId = Shop::where('user_id', auth()->id())->first()->id;

        $reservations = Reservation::where('shop_id', $shopId)
            ->with(['user', 'menu'])
            ->orderBy('reservation_date', 'asc')
            ->get();

        return view('representative.reservation-list', compact('reservations'));
    }

    public function showReservationDetailPage(Reservation $reservation = null)
    {
        if (!$reservation) {
            abort(404, '予約が見つかりません。');
        }

        $reservation->load(['user', 'shop', 'menu']);

        if ($reservation->shop_id !== auth()->user()->shop->id) {
            abort(403, 'この予約情報を閲覧する権限がありません。');
        }

        return view('representative.reservation-detail', compact('reservation'));
    }
}
