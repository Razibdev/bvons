<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\LikeEvent;
use App\Listeners\LikeEventListener;
use App\Events\CommentEvent;
use App\Listeners\CommentEventListener;

use App\Events\PostEvent;
use App\Listeners\PostEventListener;

use App\Events\PostEditEvent;
use App\Listeners\PostEditEventListener;
use App\Events\PostDeleteEvent;
use App\Listeners\PostDeleteEventListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LikeEvent::class => [
            LikeEventListener::class,
        ],

        CommentEvent::class => [
            CommentEventListener::class,
        ],

        PostEvent::class => [
            PostEventListener::class,
        ],

        PostEditEvent::class => [
            PostEditEventListener::class,
        ],

        PostDeleteEvent::class => [
            PostDeleteEventListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
