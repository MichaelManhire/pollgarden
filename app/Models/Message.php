<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Mark the message as read.
     *
     * @return void
     */
    public function markAsRead()
    {
        if (is_null($this->read_at)) {
            $this->forceFill(['read_at' => $this->freshTimestamp()])->save();
        }
    }

    /**
     * Get the user that the authenticated user is messaging.
     */
    public function partner()
    {
        if ($this->sender_id === Auth::id()) {
            return $this->recipient;
        }

        return $this->sender;
    }

    /**
     * Determine if a message has been read.
     *
     * @return bool
     */
    public function read()
    {
        return $this->read_at !== null;
    }

    /**
     * Get the user that received the message.
     */
    public function recipient()
    {
        return $this->belongsTo('App\Models\User', 'recipient_id');
    }

    /**
     * Get the user that sent the message.
     */
    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'sender_id');
    }
}
