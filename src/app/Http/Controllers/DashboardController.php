<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function adminIndex()
    {
        $totalUsers = User::where('role', 1)->count();

        $totalRepresentatives = User::where('role', 2)->count();

        return view('admin.dashboard', compact('totalUsers', 'totalRepresentatives'));
    }
}
