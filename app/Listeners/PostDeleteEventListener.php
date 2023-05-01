<?php

namespace App\Listeners;

use App\Events\PostDeleteEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostDeleteEventListener
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
     * @param  PostDeleteEvent  $event
     * @return void
     */
    public function handle(PostDeleteEvent $event)
    {
        //
    }
}
