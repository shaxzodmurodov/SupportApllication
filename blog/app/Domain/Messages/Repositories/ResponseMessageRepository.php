<?php

namespace App\Domain\Messages\Repositories;

use App\Response;

class ResponseMessageRepository
{
    public function save(Response $responseMessage)
    {
        $responseMessage->save();
    }
}
