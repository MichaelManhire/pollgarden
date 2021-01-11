<form class="inline-block ml-2" wire:submit.prevent="submitLike">
    @can('create', App\Models\Like::class)
        <button
            class="relative top-1 inline-block transition {{ $hasBeenLikedByUser ? 'text-green-700' : 'text-gray-500 hover:text-green-900' }}"
            type="submit"
            title="{{ $hasBeenLikedByUser ? 'Unlike' : 'Like' }}"
        >
            <x-icons.like />
            <span class="sr-only">{{ $hasBeenLikedByUser ? 'Unlike' : 'Like' }}</span>
        </button>
    @else
        <div class="relative top-1 inline-block text-gray-500">
            <x-icons.like />
        </div>
    @endcan

    <p class="inline-block text-sm">
        <span>{{ $numberOfLikes }}</span>
        <span class="sr-only">{{ Str::plural('like', $numberOfLikes) }}</span>
    </p>
</form>
