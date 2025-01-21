<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Log;
use App\Models\Reservation;

class StripeController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        DB::beginTransaction();

        try {
            $amount = $request->input('amount');

            $reservationId = $request->input('reservation_id');
            $reservation = Reservation::findOrFail($reservationId);

            $lineItem = [
                'price_data' => [
                    'currency' => 'jpy',
                    'unit_amount' => $amount,
                    'product_data' => [
                        'name' => $reservation->menu->name . '✖️' . $reservation->number_of_people,
                    ],
                ],
                'quantity' => 1,
            ];

            $from = $request->input('from');
            $shopId = $reservation->shop->id;

            $checkoutSession = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [$lineItem],
                'mode' => 'payment',
                'success_url' => route('reservation.success', ['from' => $from]),
                'cancel_url' => route('reservation.cancel', ['shopId' => $shopId, 'from' => $from]),
                'customer_email' => auth()->user()->email,
                'payment_intent_data' => [
                    'metadata' => [
                        'reservation_id' => $reservation->id,
                    ],
                ],
            ]);

            $reservation->stripe_session_id = $checkoutSession->id;
            $reservation->save();

            DB::commit();

            Log::info('Stripe Checkoutセッションが作成されました', [
                'session_id' => $checkoutSession->id,
                'reservation_id' => $reservation->id,
            ]);

            return redirect($checkoutSession->url);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Stripe決済エラー', [
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->route('detail.show', ['shop_id' => $shopId]);
        }
    }

    public function handleSuccess(Request $request)
    {
        $from = $request->input('from');

        return redirect()->route('done', ['from' => $from]);
    }

    public function handleCancel(Request $request)
    {
        DB::beginTransaction();

        try {
            $shopId = $request->input('shopId');
            $reservation = Reservation::where('user_id', auth()->id())
                ->where('shop_id', $shopId)
                ->where('payment_status', 'pending')
                ->first();

            if ($reservation) {
                $reservation->forceDelete();
            }

            $from = $request->input('from');

            DB::commit();

            return redirect()->route('detail.show', ['shop_id' => $shopId, 'from' => $from]);
        } catch (\Exception $e) {
            DB::rollback();

            Log::error('キャンセル処理エラー', [
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);

            return redirect()->route('top.show');
        }
    }
}
