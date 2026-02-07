<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

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
        // 1. Kustomisasi Email Verifikasi
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('verify your presence.')
                ->greeting('hello.')
                ->line('welcome to the writeforhuman. a place for handcrafted thoughts.')
                ->line('please confirm your email address to begin your journey.')
                ->action('Confirm Presence', $url)
                ->line('if you did not create an account, no further action is required.')
                ->salutation('regards, writeforhuman.');
        });

        // 2. Kustomisasi Email Reset Password
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->subject('recover your access.')
                ->greeting('forgotten?')
                ->line('it happens to the best of us.')
                ->line('click the button below to reset ваyour password.')
                ->action('Reset Password', $url)
                ->line('this link will expire in 60 minutes.')
                ->line('if you did not request this, please ignore this thought.')
                ->salutation('stay safe, writeforhuman.');
        });
    }
}