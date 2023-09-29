<?php

namespace App\Listeners;

use Illuminate\Auth\Events\PasswordReset;
use App\Notifications\ResetPasswordSuccess;

class SendPasswordReset
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PasswordReset $event)
    {
        $user = $event->user;

        $user->notify(new ResetPasswordSuccess($user));
    }
}
