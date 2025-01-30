<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ReviewController extends Controller
{
    public function show(Shop $shop)
    {
        return view('review', compact('shop'));
    }
}
