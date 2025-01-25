<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;

Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard');

    Route::get('/representative_registration', [RegisterController::class, 'show'])->name('show.register');

    Route::post('/representative_registration', [RegisterController::class, 'create'])->name('create.representative');
});
