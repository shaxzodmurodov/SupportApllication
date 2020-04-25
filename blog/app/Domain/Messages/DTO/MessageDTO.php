<?php

namespace App\Domain\Messages\DTO;

use Illuminate\Http\UploadedFile;

class MessageDTO
{

    /**
     * @var string
     */
    public $theme;

    /**
     * @var string
     */
    public $message;

    /**
     * @var int
     */
    public $response;

    /**
     * @var int
     */
    public $user_id;

    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * @var string
     */
    public $size;

    /**
     * @var string
     */
    public $path;

    /**
     * @var string
     */
    public $mime;
}
