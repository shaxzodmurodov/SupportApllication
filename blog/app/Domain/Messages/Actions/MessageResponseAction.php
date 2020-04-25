<?php

namespace App\Domain\Messages\Actions;

use App\Domain\Messages\DTO\ResponseMessageDTO;
use App\Domain\Messages\Events\MessageResponseEvent;
use App\Domain\Messages\Repositories\MessagesRepository;
use App\Domain\Messages\Repositories\ResponseMessageRepository;
use App\Message;
use App\Response;

class MessageResponseAction
{
    /**
     * @var ResponseMessageRepository
     */
    private $responseMessageRepository;
    /**
     * @var MessagesRepository
     */
    private $messagesRepository;

    /**
     * MessageResponseAction constructor.
     * @param ResponseMessageRepository $responseMessageRepository
     * @param MessagesRepository $messagesRepository
     */
    public function __construct(responseMessageRepository $responseMessageRepository, MessagesRepository $messagesRepository)
    {
        $this->responseMessageRepository = $responseMessageRepository;
        $this->messagesRepository = $messagesRepository;
    }

    /**
     * Класс для отправки ответа полченной заявки
     * @param ResponseMessageDTO $responseMessageDTO
     * @var Message $message
     * @var Response $responseMessage
     */
    public function execute(ResponseMessageDTO $responseMessageDTO)
    {
        $responseMessage = new Response();
        $message = $this->messagesRepository->show($responseMessageDTO->message_id);
        $responseMessage->response_text = $responseMessageDTO->response_text;
        $responseMessage->message_theme = $responseMessageDTO->response_theme;
        $responseMessage->message_id = $responseMessageDTO->message_id;
        $this->responseMessageRepository->save($responseMessage);
        $message->response = 1;
        $message->save();
        event(new MessageResponseEvent($responseMessage->message));
    }
}
