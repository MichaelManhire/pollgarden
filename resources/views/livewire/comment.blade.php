<li
    class="mt-6"
    x-data="{ isReplying: false, isEditing: false }"
    x-on:reply-posted.window="isReplying = false"
    x-on:comment-updated.window="isEditing = false"
>
    <article>
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <x-media-object>
                    <x-slot name="media">
                        <a href="{{ route('users.show', $comment->author) }}">
                            <x-avatar :user="$comment->author" />
                        </a>
                    </x-slot>

                    <x-slot name="body">
                        <h3 class="text-lg font-semibold">
                            <a class="hover:underline" href="{{ route('users.show', $comment->author) }}">
                                {{ $comment->author->name }}
                            </a>
                        </h3>

                        <p class="mt-2">{{ $comment->body }}</p>
                    </x-slot>
                </x-media-object>
            </div>

            <div class="border-t border-gray-200 px-4 py-4 sm:px-6">
                <x-comment-footer :comment="$comment" :poll="$poll" />
            </div>
        </div>

        @can('create', App\Models\Comment::class)
            <div x-show="isReplying">
                @livewire('comment-reply-form', ['pollId' => $poll->id, 'parentComment' => $comment])
            </div>
        @endcan

            @can('update', $comment)
                <div x-show="isEditing">
                    @livewire('comment-edit-form', ['comment' => $comment])
                </div>
            @endcan

        @livewire('comment-reply-list', ['comment' => $comment, 'poll' => $poll])
    </article>
</li>
