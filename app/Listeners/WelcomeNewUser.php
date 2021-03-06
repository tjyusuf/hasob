<?php

namespace App\Listeners;

use App\Events\NewUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeNewUser as WelcomeUser;

class WelcomeNewUser
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
     * @param  \App\Events\NewUser  $event
     * @return void
     */
    public function handle(NewUser $event)
    {
        Mail::send(new WelcomeUser());
        info('Welcome message. New user '.$event->user->id);
    }
}
