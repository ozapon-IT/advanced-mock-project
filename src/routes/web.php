<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MypageController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest_or_user'])->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');

    Route::get('/detail/{shop_id}', [ShopController::class, 'show'])->name('detail.show');

    Route::get('/detail/{shop}/reviews', [ReviewController::class, 'index'])->name('reviews.index');

    Route::get('/thanks', function () {
        return view('auth.thanks');
    })->name('auth.thanks');
});

Route::middleware(['auth', 'role:1'])->group(function () {
    Route::post('/detail/{shop}/reservations', [ReservationController::class, 'store'])->name('reservations.store');

    Route::get('/done', [ReservationController::class, 'done'])->name('reservations.done');

    Route::post('/favorite/{shop}', [FavoriteController::class, 'store'])->name('favorites.store');

    Route::delete('/favorite/{shop}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.index');

    Route::delete('/mypage/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');

    Route::get('/mypage/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');

    Route::patch('/mypage/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');

    Route::get('/mypage/reviews/{shop}/create', [ReviewController::class, 'create'])->name('reviews.create');

    Route::post('/mypage/reviews/{shop}', [ReviewController::class, 'store'])->name('reviews.store');

    Route::patch('/mypage/reviews/{shop}', [ReviewController::class, 'update'])->name('reviews.update');

    Route::get('/payments/checkout', [StripeController::class, 'checkout'])->name('payments.checkout');

    Route::get('/payments/success', [StripeController::class, 'handleSuccess'])->name('payments.success');

    Route::get('/payments/cancel', [StripeController::class, 'handleCancel'])->name('payments.cancel');
});

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware('signed', 'setUserFromId')->name('verification.verify');