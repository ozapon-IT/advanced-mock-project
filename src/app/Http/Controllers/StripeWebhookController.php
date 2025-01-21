<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Reservation;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sigHeader, $secret);

            Log::info('Webhook received', ['type' => $event->type]);

            switch ($event->type) {
                case 'checkout.session.completed':
                    $this->handleCheckoutSessionCompleted($event);
                    break;

                case 'payment_intent.payment_failed':
                    $this->handlePaymentIntentPaymentFailed($event);
                    break;

                default:
                    Log::info('Unhandled event type', ['type' => $event->type]);
                    break;
            }
        } catch (\UnexpectedValueException $e) {
            Log::error('Invalid payload', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('Invalid signature', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        return response()->json(['status' => 'success'], 200);
    }

    public function handleCheckoutSessionCompleted($event)
    {
        $session = $event->data->object;

        Log::info('Checkout session completed', ['session_id' => $session->id]);

        $reservation = Reservation::where('stripe_session_id', $session->id)->first();

        if ($reservation) {
            if ($reservation->payment_status !== 'paid') {
                if (isset($session->payment_status) && $session->payment_status === 'paid') {
                    $reservation->payment_status = 'paid';
                    $reservation->save();
                }

                Log::info('Reservation payment status updated to paid in checkout.session.completed.', ['reservation_id' => $reservation->id]);
            } else {
                Log::info('Reservation already paid. No action needed.', ['reservation_id' => $reservation->id]);
            }
        } else {
            Log::warning('No reservation found for this session_id. Skipping update', ['session_id' => $session->id]);
        }
    }

    public function handlePaymentIntentPaymentFailed($event)
    {
        $session = $event->data->object;

        Log::info('Received payment intent payment failed event', ['event_data' => $session]);

        $reservationId = $session->metadata->reservation_id ?? null;

        if ($reservationId) {
            $reservation = Reservation::find($reservationId);

            if($reservation) {
                $reservation->payment_status = 'failed';
                $reservation->save();

                Log::info('Reservation payment status updated to failed in payment_intent.payment_failed.', ['reservation_id' => $reservation->id]);
            } else {
                Log::error('Reservation not found for reservation_id', ['reservation_id' => '$reservationId']);
            }
        } else {
            Log::error('No reservation_id found in event metadata.', ['session_id' => $session->id]);
        }
    }
}
