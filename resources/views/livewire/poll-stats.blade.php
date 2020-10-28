<div class="flex items-center text-gray-500 text-sm leading-5">
    <div>
        <x-icons.poll />
    </div>
    <p class="ml-1">
        {{ $votes }} {{ Str::plural('vote', $votes) }}
    </p>
    <div class="ml-3">
        <x-icons.comment />
    </div>
    <p class="ml-1">
        {{ $comments }} {{ Str::plural('comment', $comments) }}
    </p>
</div>
