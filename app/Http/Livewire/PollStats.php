<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PollStats extends Component
{
    public $votes;
    public $comments;

    protected $listeners = ['incrementVotes', 'incrementComments'];

    public function incrementVotes()
    {
        $this->votes = $this->votes + 1;
    }

    public function incrementComments()
    {
        $this->comments = $this->comments + 1;
    }

    public function render()
    {
        return view('livewire.poll-stats');
    }
}
