<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeactivateNewUser
{
    public function handle(Registered $event): void
    {
        $event->user->update([
            'is_active' => false,
        ]);
    }
}
