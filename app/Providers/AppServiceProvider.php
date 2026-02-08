<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL; // Tambahkan ini

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paksa semua URL dan Cookie menggunakan HTTPS di production
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // 1. Kustomisasi Email Verifikasi
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verify your presence.')
                ->greeting('Hello.')
                ->line('Welcome to the dwrite.me. a place for handcrafted thoughts.')
                ->line('Please confirm your email address to begin your journey.')
                ->action('Confirm Presence', $url)
                ->line('If you did not create an account, no further action is required.')
                ->salutation('Regards, dwrite.me.');
        });

        // 2. Kustomisasi Email Reset Password
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->subject('Recover your access.')
                ->greeting('Forgotten?')
                ->line('It happens to the best of us.')
                ->line('Click the button below to reset your password.')
                ->action('Reset Password', $url)
                ->line('This link will expire in 60 minutes.')
                ->line('If you did not request this, please ignore this thought.')
                ->salutation('Stay safe, dwrite.me.');
        });
    }
}