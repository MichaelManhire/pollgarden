<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BallotBoxOption extends Component
{
    public $index;
    public $option;
    public $poll;
    public $totalVotes;
    public $numberOfVotes;

    protected function getListeners()
    {
        return [
            'incrementNumberOfVotesFor' . $this->option->id => 'incrementNumberOfVotes',
            'decrementNumberOfVotesFor' . $this->option->id => 'decrementNumberOfVotes',
            'incrementTotalVotes',
        ];
    }

    public function mount()
    {
        $this->numberOfVotes = $this->option->votes->count();
        $this->totalVotes = $this->poll->votes->count();
    }

    public function incrementNumberOfVotes()
    {
        $this->numberOfVotes = $this->numberOfVotes + 1;
    }

    public function decrementNumberOfVotes()
    {
        $this->numberOfVotes = $this->numberOfVotes - 1;
    }

    public function incrementTotalVotes()
    {
        $this->totalVotes = $this->totalVotes + 1;
    }

    public function render()
    {
        return view('livewire.ballot-box-option');
    }
}
