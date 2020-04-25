<?php

namespace App\Domain\Messages\Actions;

use App\Domain\Messages\DTO\MessageDTO;
use App\Domain\Messages\Events\MessageCreateEvent;
use App\Domain\Messages\Events\MessageResponseEvent;
use App\Domain\Messages\Repositories\MessagesRepository;
use App\File;
use App\Message;


class MessageStoreOrUpdateAction
{
    /**
     * @var MessagesRepository
     */
    private $messagesRepository;

    /**
     * MessageStoreOrUpdateAction constructor.
     * @param MessagesRepository $messagesRepository
     */
    public function __construct(MessagesRepository $messagesRepository)
    {
        $this->messagesRepository = $messagesRepository;
    }

    /**
     * Класс для отправки заявки
     * @param MessageDTO $messageDTO
     * @param Message|null $message
     */
    public function execute(MessageDTO $messageDTO, ?Message $message = null)
    {
        if (!$message) {
            $message = new Message();
        }
        $message->message = $messageDTO->message;
        $message->theme = $messageDTO->theme;
        $message->user_id = $messageDTO->user_id;

        $this->messagesRepository->save($message);

        if ($messageDTO->file) {
            $download = new File();
            $download->title = $messageDTO->file->getClientOriginalName();
            $download->size = $messageDTO->size;
            $download->mime = $messageDTO->mime;
            $download->path = \Storage::disk('public')->putFile('uploads', $messageDTO->file);
            $download->save();
            $download->message()->save($message);
        }

        event(new MessageCreateEvent($message));

    }
}
