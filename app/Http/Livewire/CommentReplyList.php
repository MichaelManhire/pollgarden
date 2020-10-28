<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentReplyList extends Component
{
    public $comment;
    public $poll;
    public $replies;

    protected function getListeners()
    {
        return ['replyPostedTo' . $this->comment->id => 'replyPosted'];
    }

    public function mount()
    {
        $this->replies = $this->comment->replies->sortByDesc('created_at');
    }

    public function replyPosted($replyId)
    {
        $reply = Comment::find($replyId);
        $replies = $this->replies->prepend($reply);

        $this->replies = $replies;
    }

    public function render()
    {
        return view('livewire.comment-reply-list');
    }
}
