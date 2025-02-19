<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\MenuController;

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'showRepresentativeDashboard'])->name('representative.dashboard');

    Route::get('/reservations', [ReservationController::class, 'index'])->name('representative.reservations.index');

    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('representative.reservations.show');

    Route::patch('/reservations/{reservation}', [ReservationController::class, 'update'])->name('representative.reservations.update');

    Route::get('/shop/edit', [ShopController::class, 'edit'])->name('representative.shop.edit');

    Route::post('/shop/edit', [ShopController::class, 'store'])->name('representative.shop.store');

    Route::patch('/shop/edit/{shop}', [ShopController::class, 'update'])->name('representative.shop.update');

    Route::get('/shop/menu/edit', [MenuController::class, 'edit'])->name('representative.shop.menu.edit');

    Route::post('/shop/menu/edit', [MenuController::class, 'store'])->name('representative.shop.menu.store');

    Route::patch('/shop/menu/edit/{menu}', [MenuController::class, 'update'])->name('representative.shop.menu.update');
});
