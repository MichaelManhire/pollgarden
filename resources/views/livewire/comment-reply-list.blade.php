<ol class="ml-4 md:ml-8">
    @foreach ($replies as $reply)
        @livewire('comment', ['comment' => $reply, 'poll' => $poll], key($reply->id))
    @endforeach
</ol>
