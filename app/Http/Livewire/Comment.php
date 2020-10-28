<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Comment extends Component
{
    public $comment;
    public $poll;

    protected $listeners = ['updatedComment'];

    protected function getListeners()
    {
        return ['updatedComment' . $this->comment->id => 'updatedComment'];
    }

    public function updatedComment($body)
    {
        $this->comment->body = $body;
    }

    public function render()
    {
        return view('livewire.comment');
    }
}
