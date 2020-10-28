<div>
    <ol>
        @foreach ($comments as $comment)
            @livewire('comment', ['comment' => $comment, 'poll' => $poll], key($comment->id))
        @endforeach
    </ol>

    @if ($comments->count() && $max !== ($index + 1))
        <div class="mt-6 text-center">
            <x-button type="button" wire:click="loadMoreComments">{{ __('Load More Comments') }}</x-button>
        </div>
    @endif
</div>
