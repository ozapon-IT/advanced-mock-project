<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * 指定されたロールに基づいてリクエストを処理
     *
     * @param Request $request リクエストインスタンス
     * @param Closure $next 次のミドルウェアまたはコントローラーへのコールバック
     * @param string $role 必要なユーザーロール
     * @return Response レスポンスオブジェクト
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (auth()->check() && auth()->user()->role == $role) {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }
}
