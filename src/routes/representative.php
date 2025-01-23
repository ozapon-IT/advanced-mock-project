<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'RepresentativeIndex'])->name('representative.dashboard');

    Route::get('/reservation_list', [ReservationController::class, 'showReservationListPage'])->name('show.reservation-list');

    Route::get('/reservation_detail/{reservation}', [ReservationController::class, 'showReservationDetailPage'])->name('show.reservation-detail');
});
