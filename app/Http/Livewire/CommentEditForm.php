<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class CommentEditForm extends Component
{
    use AuthorizesRequests;

    public $comment;
    public $body;

    protected $rules = [
        'body' => 'required|max:1000',
    ];

    public function mount()
    {
        $this->body = $this->comment->body;
    }

    public function updateComment()
    {
        $this->authorize('update', $this->comment);

        $this->validate();

        $this->comment->update([
            'body' => $this->body,
        ]);

        $this->emitTo('comment', 'updatedComment' . $this->comment->id, $this->body);
        $this->dispatchBrowserEvent('comment-updated');
    }

    public function render()
    {
        return view('livewire.comment-edit-form');
    }
}
