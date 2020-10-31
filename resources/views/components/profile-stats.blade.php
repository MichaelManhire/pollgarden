@props(['user'])

<div class="flex items-center mt-3 text-gray-500 text-sm leading-5 font-medium">
    <div>
        <x-icons.poll />
    </div>
    <p class="ml-1">
        {{ $user->polls->count() }}
        <span class="hidden sm:inline">{{ Str::plural('Poll', $user->polls->count()) }}</span>
    </p>
    <div class="ml-3">
        <x-icons.vote />
    </div>
    <p class="ml-1">
        {{ $user->votes->count() }}
        <span class="hidden sm:inline">{{ Str::plural('Vote', $user->votes->count()) }}</span>
    </p>
    <div class="ml-3">
        <x-icons.comment />
    </div>
    <p class="ml-1">
        {{ $user->comments->count() }}
        <span class="hidden sm:inline">{{ Str::plural('Comment', $user->comments->count()) }}</span>
    </p>
</div>
