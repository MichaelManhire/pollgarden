<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class CommentList extends Component
{
    use WithPagination;

    public $poll;
    public $comments;
    public $index = 0;
    public $max = 0;

    protected $listeners = ['commentPosted'];

    public function mount()
    {
        $this->comments = $this->getComments();
        $this->max = $this->poll->parentComments()->chunk(10)->count();
    }

    public function getComments()
    {
        $comments = $this->poll->parentComments()->sortByDesc('created_at');

        if ($comments->count()) {
            return $comments->chunk(10)[$this->index];
        }

        return $comments;
    }

    public function loadMoreComments()
    {
        $this->index = $this->index + 1;
        $moreComments = $this->getComments();

        $this->comments = $this->comments->concat($moreComments);
    }

    public function commentPosted()
    {
        $this->index = 0;
        $this->comments = $this->getComments();
    }

    public function render()
    {
        return view('livewire.comment-list', [
            'comments' => $this->comments,
        ]);
    }
}
