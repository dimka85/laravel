<?php

namespace App\Listeners;

use App\Jobs\SendVerificationEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyRegisteredUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        dispatch(new SendVerificationEmail($event->user));
    }
}
