<?php

namespace App\Domain\Messages\Repositories;

use App\Message;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class MessagesRepository
{
    /**
     * @return Builder[]|Collection
     */
    public function all()
    {
        return Message::with('user', 'file', 'messageResponse')->get();
    }

    /**
     * @param $id
     * @return Builder[]|Collection
     */
    public function allByUser($id)
    {
        return Message::with('file', 'messageResponse')->where('user_id', $id)->get();
    }

    /**
     * @param $id
     * @return Builder|Builder[]|Collection|Model
     */
    public function show($id)
    {
        return Message::with('user', 'file', 'messageResponse')->findOrFail($id);
    }

    /**
     * @return Builder
     */
    public function sortBy()
    {
        return Message::with('user', 'file', 'messageResponse');
    }

    /**
     * @param Message $message
     * @return Message
     */
    public function save(Message $message)
    {
        $message->save();
        return $message;
    }
}
