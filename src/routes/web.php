<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReservationController;

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

Route::get('/', [ShopController::class, 'showTopPage'])->name('top.show');

Route::get('/detail/{shop_id}', [ShopController::class, 'showDetailPage'])->name('detail.show');

Route::post('/detail/{shop_id}', [ReservationController::class, 'reserve'])->name('reserve');

Route::get('/done', [ReservationController::class, 'done'])->name('done');

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/thanks', function () {
    return view('auth.thanks');
});


Route::get('/mypage', function () {
    return view('mypage');
});