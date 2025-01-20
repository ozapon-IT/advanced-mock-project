<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function reserve(int $id, ReservationRequest $reservationRequest)
    {
        Reservation::create([
            'user_id' => auth()->id(),
            'shop_id' => $id,
            'reservation_date' => $reservationRequest->reservation_date,
            'reservation_time' => $reservationRequest->reservation_time,
            'number_of_people' => $reservationRequest->number_of_people,
        ]);

        $from = $reservationRequest->input('from');

        return redirect()->route('done', ['from' => $from]);
    }

    public function done()
    {
        return view('done');
    }

    public function deleteReservation(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->back();
    }

    public function show(Reservation $reservation)
    {
        return view('reservation-change', compact('reservation'));
    }

    public function changeReservation(Reservation $reservation, ReservationRequest $reservationRequest)
    {
        $reservation->update([
            'reservation_date' => $reservationRequest->reservation_date,
            'reservation_time' => $reservationRequest->reservation_time,
            'number_of_people' => $reservationRequest->number_of_people,
        ]);

        return redirect()->route('mypage.show');
    }
}
