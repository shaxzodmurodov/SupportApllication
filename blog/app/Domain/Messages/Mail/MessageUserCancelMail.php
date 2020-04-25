<?php

namespace App\Domain\Messages\Mail;

use App\Message;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageUserCancelMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Message
     */
    private $message;
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new message instance.
     *
     * @param Message $message
     * @param User $user
     */
    public function __construct(Message $message, User $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->user->email;
        return $this->view('users.mail.sendCancelMail', ['data' => $this->message])
            ->from($mail);
    }
}
