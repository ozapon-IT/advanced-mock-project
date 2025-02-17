<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AnnounceController;

Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'showAdminDashboard'])->name('admin.dashboard');

    Route::get('/representatives/register', [RegisterController::class, 'create'])->name('admin.representatives.create');

    Route::post('/representatives/register', [RegisterController::class, 'store'])->name('admin.representatives.store');

    Route::get('/users/announce', [AnnounceController::class, 'showAnnounce'])->name('admin.users.announce');

    Route::post('/users/announce', [AnnounceController::class, 'storeAndSend'])->name('admin.users.announce.send');

    Route::get('/users/announce/{announce}', [AnnounceController::class, 'show'])->name('admin.users.announce.show');
});
