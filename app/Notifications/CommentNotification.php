<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CommentNotification extends Notification
{
    use Queueable;

    protected $comment;

    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['database']; // Kita simpan di database
    }

    public function toArray($notifiable)
    {
        return [
            'article_id' => $this->comment->article_id,
            'article_title' => $this->comment->article->title,
            'article_slug' => $this->comment->article->slug,
            'user_name' => $this->comment->user->name,
            'comment_body' => $this->comment->body,
        ];
    }
}