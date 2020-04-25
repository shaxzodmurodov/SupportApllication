<?php

namespace App\Domain\Messages\Listeners;

use App\Domain\Messages\Events\MessageResponseEvent;
use App\Jobs\MessageResponseSendMailJob;

class MessageResponseListener
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
     * @param MessageResponseEvent $event
     * @return void
     */
    public function handle(MessageResponseEvent $event)
    {
        MessageResponseSendMailJob::dispatch($event->message)->delay(now()->addMinutes(1));
    }
}
