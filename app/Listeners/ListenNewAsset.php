<?php

namespace App\Listeners;

use App\Events\NewAsset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenNewAsset
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
     * @param  \App\Events\NewAsset  $event
     * @return void
     */
    public function handle(NewAsset $event)
    {
        info('New Asset '.$event->asset->id);
    }
}
