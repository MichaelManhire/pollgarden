<?php

namespace App\Http\Livewire;

use App\Models\Like;
use App\Notifications\LikeReceived;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikeButton extends Component
{
    use AuthorizesRequests;

    public $comment;
    public $hasBeenLikedByUser;
    public $numberOfLikes;

    public function mount()
    {
        $this->hasBeenLikedByUser = Auth::check() && Auth::user()->hasLiked($this->comment);
    }

    public function submitLike()
    {
        $this->authorize('create', Like::class);

        if ($this->hasBeenLikedByUser) {
            return $this->deleteLike();
        }

        $like = Like::create([
            'user_id' => Auth::id(),
            'comment_id' => $this->comment->id,
        ]);

        $this->numberOfLikes = $this->numberOfLikes + 1;
        $this->hasBeenLikedByUser = true;

        if ($this->comment->author->id !== Auth::id()) {
            $this->comment->author->notify(new LikeReceived($like));
        }
    }

    public function deleteLike()
    {
        $like = Like::where('comment_id', $this->comment->id)->where('user_id', Auth::id())->first();

        $this->authorize('delete', $like);

        $like->delete();

        $this->numberOfLikes = $this->numberOfLikes - 1;
        $this->hasBeenLikedByUser = false;
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
