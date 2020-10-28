@props(['user'])

<div class="flex items-center mt-3 text-gray-500 text-sm leading-5 font-medium">
    <div>
        <x-icons.poll />
    </div>
    <p class="ml-1">
        {{ $user->polls->count() }} {{ Str::plural('Poll', $user->polls->count()) }}
    </p>
    <div class="ml-3">
        <x-icons.vote />
    </div>
    <p class="ml-1">
        {{ $user->votes->count() }} {{ Str::plural('Vote', $user->votes->count()) }}
    </p>
    <div class="ml-3">
        <x-icons.comment />
    </div>
    <p class="ml-1">
        {{ $user->comments->count() }} {{ Str::plural('Comment', $user->comments->count()) }}
    </p>
</div>
