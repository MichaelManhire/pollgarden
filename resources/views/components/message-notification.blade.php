@props(['message', 'isRead'])

<a href="{{ route('messages.show', $message->partner()) }}">
    <x-panel class="relative hover:bg-gray-50 base-transition">
        <x-media-object>
            <x-slot name="media">
                <x-avatar :user="$message->partner()" />
            </x-slot>

            <x-slot name="body">
                <h2 class="text-lg font-semibold">{{ $message->partner()->name }}</h2>
                <p class="mt-2">{{ Str::limit($message->body, 200) }}</p>
            </x-slot>
        </x-media-object>

        <div class="absolute top-2 right-2.5">
            @if ($isRead)
                <span class="text-gray-300">
                    <x-icons.message-open />
                </span>
            @else
                <span class="text-green-400">
                    <x-icons.message />
                </span>
            @endif
        </div>
    </x-panel>
</a>
