@props(['notification', 'isRead'])

<article>
    <a href="{{ route('polls.show', $notification->data['pollSlug']) }}">
        <x-panel class="relative hover:bg-gray-50 base-transition">
            <div class="flex">
                @if ($notification->type === 'App\Notifications\CommentReceived')
                    <div class="relative top-0.5 mr-1.5 text-gray-600">
                        <x-icons.comment />
                    </div>

                    <p>{{ $notification->data['author'] }} {{ __('commented on your poll,') }} &ldquo;{{ $notification->data['poll'] }}&rdquo;:</p>
                @endif

                @if ($notification->type === 'App\Notifications\CommentReplyReceived')
                    <div class="relative top-0.5 mr-1.5 text-gray-600">
                        <x-icons.comment />
                    </div>

                    <p>{{ $notification->data['author'] }} {{ __('replied to your comment on') }} &ldquo;{{ $notification->data['poll'] }}&rdquo;:</p>
                @endif

                @if ($notification->type === 'App\Notifications\LikeReceived')
                    <div class="relative top-0.5 mr-1.5 text-gray-600">
                        <x-icons.like />
                    </div>

                    <p>{{ $notification->data['liker'] }} {{ __('liked your comment on') }} &ldquo;{{ $notification->data['poll'] }}&rdquo;:</p>
                @endif
            </div>

            <blockquote class="pl-7 mt-2 text-sm italic">
                <p>{{ $notification->data['comment'] }}</p>
            </blockquote>

            <div class="absolute top-2 right-2.5">
                @if ($isRead)
                    <span class="text-gray-300">
                        <x-icons.seen />
                    </span>
                @else
                    <span class="text-green-400">
                        <x-icons.unseen />
                    </span>
                @endif
            </div>
        </x-panel>
    </a>
</article>
