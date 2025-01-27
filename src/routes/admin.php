<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AnnounceController;

Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard');

    Route::get('/representative_registration', [RegisterController::class, 'show'])->name('show.register');

    Route::post('/representative_registration', [RegisterController::class, 'create'])->name('create.representative');

    Route::get('/announce', [AnnounceController::class, 'showAnnouncePage'])->name('show.announce');

    Route::post('/announce', [AnnounceController::class, 'send'])->name('send.announce');

    Route::get('/announce/detail/{announce}', [AnnounceController::class, 'showDetailPage'])->name('show.detail');
});
