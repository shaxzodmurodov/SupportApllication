<?php

namespace App\Domain\Messages\Listeners;

use App\Domain\Messages\Events\MessageCancelEvent;
use App\Jobs\MessageUserCancelSendMailJob;
use App\Jobs\MessageManagerCancelSendMailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MessageCancelListener
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
     * @param MessageCancelEvent $event
     * @return void
     */
    public function handle(MessageCancelEvent $event)
    {
        if ($event->cancelType == 1) {
            MessageUserCancelSendMailJob::dispatch($event->message)->delay(now()->addMinutes(1));
        } elseif ($event->cancelType == 2) {
            MessageManagerCancelSendMailJob::dispatch($event->message)->delay(now()->addMinutes(1));
        }
    }
}
