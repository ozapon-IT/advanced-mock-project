<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestOrUser
{
    /**
     * ゲスト(未ログイン) または role=1 のユーザーだけ通過
     * それ以外(role=2, 3など)のログインユーザーには 403 を返す
     *
     * @param Request $request リクエストインスタンス
     * @param Closure $next 次のミドルウェアまたはコントローラーへのコールバック
     * @return Response レスポンスオブジェクト
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return $next($request);
        }

        if (auth()->user()->role == 1) {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }
}
