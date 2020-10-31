<div class="flex items-center text-gray-500 text-sm leading-5">
    <div>
        <x-icons.poll />
    </div>
    <p class="ml-1">
        {{ $votes }}
        <span class="hidden sm:inline">{{ Str::plural('vote', $votes) }}</span>
    </p>
    <div class="ml-3">
        <x-icons.comment />
    </div>
    <p class="ml-1">
        {{ $comments }}
        <span class="hidden sm:inline">{{ Str::plural('comment', $comments) }}</span>
    </p>
</div>
