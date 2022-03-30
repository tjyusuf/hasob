<?php

namespace App\Listeners;

use App\Events\NewAssignment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenNewAssignment
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
     * @param  \App\Events\NewAssignment  $event
     * @return void
     */
    public function handle(NewAssignment $event)
    {
        info('New Assignment '.$event->assignment->id);
    }
}
