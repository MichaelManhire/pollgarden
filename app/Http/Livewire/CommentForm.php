<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Notifications\CommentReceived;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentForm extends Component
{
    use AuthorizesRequests;

    public $poll;
    public $body;

    protected $rules = [
        'body' => 'required|string|max:1000',
    ];

    public function submitComment()
    {
        $this->authorize('create', Comment::class);

        $this->validate();

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'poll_id' => $this->poll->id,
            'body' => $this->body,
        ]);

        $this->reset('body');
        $this->emitTo('comment-list', 'commentPosted');
        $this->emitTo('poll-stats', 'incrementComments');

        if ($this->poll->author->id !== Auth::id()) {
            $this->poll->author->notify(new CommentReceived($comment));
        }
    }

    public function render()
    {
        return view('livewire.comment-form');
    }
}
