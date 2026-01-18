<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Login;
use App\Listeners\DeactivateNewUser;
use App\Listeners\LogoutInactiveUser;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            DeactivateNewUser::class,
        ],

        Login::class => [
            LogoutInactiveUser::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}
