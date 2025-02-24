<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeWebhookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// 認証ユーザー情報取得ルート
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 合計金額を計算するAPIルート
Route::get('/calculate-total', function (Request $request) {
    $shopId = $request->query('shop_id');
    $menuName = $request->query('menu_name');
    $numberOfPeople = (int) $request->query('number_of_people', 0);

    $totalAmount = calculateTotalAmount($numberOfPeople, $menuName, $shopId);

    return response()->json([
        'amount' => $totalAmount,
        'formatted_amount' => formattedTotalAmount($totalAmount),
    ]);
});

// Stripe Webhookイベントルート
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);
