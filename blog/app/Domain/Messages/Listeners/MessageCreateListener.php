<?php

namespace App\Domain\Messages\Listeners;

use App\Domain\Messages\Events\MessageCreateEvent;
use App\Jobs\SendMessageCreateEventMailJob;

class MessageCreateListener
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
     * @param MessageCreateEvent $event
     * @return void
     */
    public function handle(MessageCreateEvent $event)
    {
        SendMessageCreateEventMailJob::dispatch($event->message)->delay(now()->addMinutes(1));
    }
}
