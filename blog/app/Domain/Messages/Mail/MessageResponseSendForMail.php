<?php

namespace App\Domain\Messages\Mail;

use App\Message;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageResponseSendForMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Message
     */
    private $message;

    /**
     * Create a new message instance.
     *
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = User::whereRoleId(2)->firstOrFail()->email;
        return $this->view('admins.mail.sendMail', ['data' => $this->message])
            ->from($user);
    }
}
