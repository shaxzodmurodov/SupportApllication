<?php

namespace App\Domain\Messages\Actions;

use App\Domain\Messages\Events\MessageCancelEvent;
use App\Message;

class MessageCancelingAction
{
    /**
     * Класс для отмены заявки
     * @param Message $message
     * @param int $cancelType
     */
    public function execute(Message $message, $cancelType)
    {
        if ($cancelType == 1) {
            $message->user_canceled = 1;
            $message->read = 1;
        } elseif ($cancelType == 2) {
            $message->manager_canceled = 1;
            $message->read = 1;
        }
        $message->save();
        event(new MessageCancelEvent($message, $cancelType));
    }
}
