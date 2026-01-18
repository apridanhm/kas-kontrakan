<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;

class LogoutInactiveUser
{
    public function handle(Login $event): void
    {
        if (! $event->user->is_active) {
            Auth::logout();

            session()->invalidate();
            session()->regenerateToken();

            session()->flash(
                'error',
                'Akun kamu belum di-approve admin.'
            );
        }
    }
}
