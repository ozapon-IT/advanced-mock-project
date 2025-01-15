<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('shop-list');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/thanks', function () {
    return view('auth.thanks');
});

Route::get('/detail/{shop_id}', function () {
    return view('detail');
});

Route::get('/done', function () {
    return view('done');
});

Route::get('/mypage', function () {
    return view('mypage');
});