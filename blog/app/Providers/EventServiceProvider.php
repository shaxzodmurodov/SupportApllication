<?php

namespace App\Providers;

use App\Domain\Messages\Events\MessageCancelEvent;
use App\Domain\Messages\Events\MessageCreateEvent;
use App\Domain\Messages\Events\MessageResponseEvent;
use App\Domain\Messages\Listeners\MessageCancelListener;
use App\Domain\Messages\Listeners\MessageCreateListener;
use App\Domain\Messages\Listeners\MessageResponseListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        MessageCreateEvent::class => [
            MessageCreateListener::class
        ],
        MessageResponseEvent::class => [
            MessageREsponseListener::class
        ],
        MessageCancelEvent::class => [
            MessageCancelListener::class
        ]
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
