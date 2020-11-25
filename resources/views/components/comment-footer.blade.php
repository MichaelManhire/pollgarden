@props(['comment', 'poll'])

<div class="flex justify-between items-center overflow-hidden">
    <x-byline :time="$comment->created_at" />

    @if ($comment->author->hasVotedIn($poll))
        <x-voteline
            :option="$comment->author->votedOptionIn($poll)->name"
            :color="$comment->author->votedOptionIn($poll)->color()"
            class="hidden md:flex ml-3"
        />
    @endif

    <div class="ml-auto flex-none">
        @can('create', App\Models\Comment::class)
            <x-button-tertiary
                x-text="isReplying ? 'Cancel' : 'Reply'"
                x-on:click="isReplying = !isReplying; $nextTick(() => $refs.reply{{ $comment->id }}.focus())"
            />
        @endcan

        @livewire('like-button', ['comment' => $comment, 'numberOfLikes' => $comment->numberOfLikes()])
    </div>
</div>

@can('update', $comment)
    <div class="flex justify-end mt-3">
        @can('update', $comment)
            <x-button-tertiary
                class="ml-2"
                x-text="isEditing ? 'Cancel' : 'Edit'"
                x-on:click="isEditing = !isEditing; $nextTick(() => $refs.edit{{ $comment->id }}.focus())"
            />
        @endcan

        @can('delete', $comment)
            <x-form
                class="inline-block ml-2"
                action="{{ route('comments.destroy', $comment->id) }}"
                method="DELETE"
                x-data="{ isOpen: false }"
                style="position: relative; top: -1px;"
            >
                <x-button-tertiary type="button" x-on:click="isOpen = true">{{ __('Delete') }}</x-button-tertiary>

                <x-modal :id="$comment->id">
                    <x-slot name="heading">{{ __('Delete Comment') }}</x-slot>
                    <x-slot name="body">{{ __('Are you sure you want to delete your comment?') }}</x-slot>
                    <x-slot name="primary">{{ __('Delete Comment') }}</x-slot>
                    <x-slot name="secondary">{{ __('Cancel') }}</x-slot>
                </x-modal>
            </x-form>
        @endcan
    </div>
@endcan

@if ($comment->author->hasVotedIn($poll))
    <x-voteline
        :option="$comment->author->votedOptionIn($poll)->name"
        :color="$comment->author->votedOptionIn($poll)->color()"
        class="mt-4 md:hidden"
    />
@endif
