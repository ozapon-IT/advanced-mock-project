<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    public function reserve(ReservationRequest $request, int $id)
    {
        Reservation::create([
            'user_id' => auth()->id(),
            'shop_id' => $id,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'number_of_people' => $request->number_of_people,
        ]);

        return redirect()->route('done');
    }

    public function done()
    {
        return view('done');
    }
}
