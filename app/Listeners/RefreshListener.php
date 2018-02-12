<?php

namespace App\Listeners;

use App\Events\RefreshEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RefreshListener
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
     * @param  RefreshEvent  $event
     * @return void
     */
    public function handle(RefreshEvent $event)
    {
        //
    }
}
