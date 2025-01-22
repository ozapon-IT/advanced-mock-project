<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class LoginResponse implements LoginResponseContract
{
    /**
     * ログイン成功後のレスポンスを処理します。
     *
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request): Response
    {
        $user = auth()->user();

        if ($user->role === User::ROLE_ADMIN) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === User::ROLE_REPRESENTATIVE) {
            return redirect()->route('representative.dashboard');
        }

        return redirect()->route('top.show');
    }
}