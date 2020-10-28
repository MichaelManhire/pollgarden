<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Notifications\CommentReplyReceived;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentReplyForm extends Component
{
    use AuthorizesRequests;

    public $pollId;
    public $parentComment;
    public $body;

    protected $rules = [
        'body' => 'required|string|max:1000',
    ];

    public function submitReply()
    {
        $this->authorize('create', Comment::class);

        $this->validate();

        $reply = Comment::create([
            'user_id' => Auth::id(),
            'poll_id' => $this->pollId,
            'parent_comment_id' => $this->parentComment->id,
            'body' => $this->body,
        ]);

        $this->reset('body');
        $this->emitTo('comment-reply-list', 'replyPostedTo' . $this->parentComment->id, $reply->id);
        $this->emitTo('poll-stats', 'incrementComments');
        $this->dispatchBrowserEvent('reply-posted');

        if ($this->parentComment->author->id !== Auth::id()) {
            $this->parentComment->author->notify(new CommentReplyReceived($reply));
        }
    }

    public function render()
    {
        return view('livewire.comment-reply-form');
    }
}
