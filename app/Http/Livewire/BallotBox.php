<?php

namespace App\Http\Livewire;

use App\Models\Vote;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BallotBox extends Component
{
    use AuthorizesRequests;

    public $poll;
    public $vote;

    protected $listeners = ['submitVote', 'updateVote'];

    public function mount()
    {
        // Check if the authenticated user has already voted in this poll.
        if (Auth::check()) {
            $this->vote = Auth::user()->voteIn($this->poll);
        }
    }

    public function submitVote($optionId)
    {
        $this->authorize('create', Vote::class);

        abort_if(Auth::user()->hasVotedIn($this->poll), 403, 'You have already voted in this poll.');

        $vote = Vote::create([
            'user_id' => Auth::id(),
            'option_id' => $optionId,
        ]);

        $this->vote = $vote;
        $this->emitTo('ballot-box-option', 'incrementNumberOfVotesFor' . $optionId);
        $this->emitTo('ballot-box-option', 'incrementTotalVotes');
        $this->emitTo('poll-stats', 'incrementVotes');
        $this->dispatchBrowserEvent('show-results');
    }

    public function updateVote($optionId)
    {
        $newOptionId = $optionId;
        $oldOptionId = $this->vote->option_id;

        $this->authorize('create', $this->vote);

        $this->vote->update([
            'option_id' => $newOptionId,
        ]);

        $this->emitTo('ballot-box-option', 'incrementNumberOfVotesFor' . $newOptionId);
        $this->emitTo('ballot-box-option', 'decrementNumberOfVotesFor' . $oldOptionId);
    }

    public function render()
    {
        return view('livewire.ballot-box');
    }
}
