<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Response
 *
 * @property int $id
 * @property int|null $message_id
 * @property string $message_theme
 * @property string $response_text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Message|null $message
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Response newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Response newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Response query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Response whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Response whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Response whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Response whereMessageTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Response whereResponseText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Response whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Response extends Model
{
    protected $guarded = ['id'];

    public function message()
    {
        return $this->hasOne(Message::class, 'id', 'message_id');
    }
}
