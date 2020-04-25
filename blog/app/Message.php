<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Message
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $theme
 * @property string|null $message
 * @property int|null $file_id
 * @property int $read
 * @property int $response
 * @property int $user_canceled
 * @property int $manager_canceled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\File|null $file
 * @property-read \App\Response $messageResponse
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereManagerCanceled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereUserCanceled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereUserId($value)
 * @mixin \Eloquent
 */
class Message extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function file()
    {
        return $this->hasOne(File::class, 'id', 'file_id');
    }

    public function messageResponse()
    {
        return $this->belongsTo(Response::class, 'id', 'message_id');
    }

    public function asRead()
    {
        return $this->read === 1;
    }

    public function asResponse()
    {
        return $this->response === 1;
    }

    public function asCanceled()
    {
        if ($this->manager_canceled === 1 || $this->user_canceled === 1) return true;
    }
}
