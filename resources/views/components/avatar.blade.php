@props(['user', 'isLarge' => false])

<div class="inline-block relative">
    @if ($isLarge)
        <x-image class="w-16 h-16" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" width="64" height="64" />
    @else
        <x-image src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" />
    @endif
    <span class="sr-only">{{ $user->name }}</span>

    <span class="absolute top-0 right-0 block rounded-full text-white ring-2 ring-white {{ $isLarge ? 'h-4 w-4' : 'h-3 w-3' }} {{ $user->isOnline() ? 'bg-green-400' : 'bg-gray-300'}}">
        <span class="sr-only">{{ $user->name }} {{ __('is online now.') }}</span>
    </span>
</div>
