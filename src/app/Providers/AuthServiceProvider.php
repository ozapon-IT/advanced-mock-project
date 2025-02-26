<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmailNotification::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('【Rese】メール認証のお願い')
                ->greeting('こんにちは、' . $notifiable->name . 'さん!')
                ->line('アカウントのセキュリティーを確保するために、メールアドレスの認証を完了してください。')
                ->action('メール認証を完了する', $url)
                ->line('このメールに心当たりがない場合は、このまま無視してください。');
        });
    }
}
