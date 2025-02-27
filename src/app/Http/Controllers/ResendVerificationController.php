<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;

class ResendVerificationController extends Controller
{
    public function resend()
    {
        $email = Session::get('register_email');

        if (!$email) {
            return back()->withErrors(['error' => 'メールアドレス情報がありません。再登録を行なってください。']);
        }

        $user = User::Where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['error' => '該当するメールアドレスが見つかりません。']);
        }

        if ($user->hasVerifiedEmail()) {
            return back()->withErrors(['error' => 'メールアドレスはすでに認証されています。']);
        }

        try {
            $user->notify(new VerifyEmail());
        } catch (\Exception $e) {
            Log::error('メール認証リンクの送信に失敗しました:' . $e->getMessage());
            return back()->withErrors(['error' => 'メールの送信に失敗しました。']);
        }

        return back()->with('success', '確認メールを再送信しました。');
    }
}