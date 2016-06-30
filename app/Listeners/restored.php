<?php

namespace App\Listeners;

use App\Events\restore;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class restored
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
     * @param  restore  $event
     * @return void
     */
    public function handle(restore $event)
    {
        //
    }
}
