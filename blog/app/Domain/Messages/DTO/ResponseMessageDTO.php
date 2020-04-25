<?php


namespace App\Domain\Messages\DTO;


class ResponseMessageDTO
{
    /**
     * @var int
     */
    public $message_id;

    /**
     * @var string
     */
    public $response_text;

    /**
     * @var string
     */
    public $response_theme;
}
