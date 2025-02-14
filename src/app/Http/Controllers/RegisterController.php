<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function show()
    {
        return view('admin.register');
    }

    public function create(CustomRegisterRequest $request)
    {
        $validatedData = $request->only(['name', 'email', 'password']);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'email_verified_at' => Carbon::now(),
            'role' => 2,
        ]);

        return redirect()->route('admin.dashboard')->with(['success' => '店舗代表者を登録しました。']);
    }
}
