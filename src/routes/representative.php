<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'RepresentativeIndex'])->name('representative.dashboard');

    Route::get('/reservation_list', [ReservationController::class, 'showReservationListPage'])->name('show.reservation-list');

    Route::get('/reservation_detail/{reservation}', [ReservationController::class, 'showReservationDetailPage'])->name('show.reservation-detail');

    Route::get('/shop_edit', [ShopController::class, 'showShopEditPage'])->name('show.shop-edit');

    Route::post('/shop_edit', [ShopController::class, 'create'])->name('create.shop-information');

    Route::patch('/shop_edit/{shop}', [ShopController::class, 'update'])->name('update.shop-information');
});
