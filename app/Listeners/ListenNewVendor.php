<?php

namespace App\Listeners;

use App\Events\NewVendor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenNewVendor
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
     * @param  \App\Events\NewVendor  $event
     * @return void
     */
    public function handle(NewVendor $event)
    {
        info('New Vendor '.$event->vendor->id);
    }
}
