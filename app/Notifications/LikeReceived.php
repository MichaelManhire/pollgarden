<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class LikeReceived extends Notification
{
    use Queueable;

    protected $like;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($like)
    {
        $this->like = $like;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'comment' => Str::limit($this->like->comment->body),
            'liker' => $this->like->liker->name,
            'likerSlug' => $this->like->liker->slug,
            'poll' => $this->like->comment->poll->title,
            'pollSlug' => $this->like->comment->poll->slug,
        ];
    }
}
