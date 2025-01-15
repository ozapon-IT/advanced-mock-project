<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $shops = Shop::query()
            ->filterByArea($request->area)
            ->filterByGenre($request->genre)
            ->filterByText($request->text)
            ->get();

        $areas = Shop::getAreas();
        $genres = Shop::getGenres();

        return view('index', compact('shops', 'areas', 'genres'));
    }
}
