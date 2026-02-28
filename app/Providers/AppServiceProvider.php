<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;

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
        VerifyEmail::$toMailCallback = function ($notifiable, $verificationUrl) {
            return (new MailMessage)
                ->subject(Lang::get('Verificar email en 10CodeAcademy'))
                ->line(Lang::get('Haz click en el botón para verificar tu email en tu cuenta de 10CodeAcademy.'))
                ->action(Lang::get('Verificar'), $verificationUrl)
                ->line(Lang::get('Si no has sido tu, ignora este mensaje.'));
        };
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            $resetUrl = url(config('app.url') . route('password.reset', ['token' => $token, 'email' => $notifiable->getEmailForPasswordReset()], false));

            return (new MailMessage)
                ->subject(Lang::get('Restablecer Contraseña en 10CodeAcademy'))
                ->line(Lang::get('Recibes este correo porque hemos recibido una solicitud para restablecer la contraseña de tu cuenta.'))
                ->action(Lang::get('Restablecer Contraseña'), $resetUrl)
                ->line(Lang::get('Este enlace de restablecimiento de contraseña caducará en :count minutos.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
                ->line(Lang::get('Si no has solicitado un restablecimiento de contraseña, no es necesario realizar ninguna otra acción.'));
        });
    }
}
