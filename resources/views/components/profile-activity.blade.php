@props(['user'])

<div class="flex items-center sm:block sm:ml-auto mt-6 sm:mt-0 text-gray-500 text-sm leading-5 font-medium">
    <div class="flex sm:justify-end">
        <div>
            <x-icons.calendar />
        </div>
        <p class="ml-1">
            <span class="block sm:inline">{{ __('Joined') }}:</span>
            <x-time :time="$user->created_at" class="text-gray-800" />
        </p>
    </div>

    <div class="flex sm:justify-end sm:mt-2 ml-6 sm:ml-0">
        <div>
            <x-icons.clock />
        </div>
        <p class="ml-1">
            <span class="block sm:inline">{{ __('Last Online') }}:</span>
            @if ($user->isOnline())
                <span class="text-gray-800">{{ __('Now') }}</span>
            @else
                @if (is_null($user->last_online_at))
                    <span class="text-gray-800">{{ __('Unknown') }}</span>
                @else
                    <x-time :time="$user->last_online_at" class="text-gray-800" />
                @endif
            @endif
        </p>
    </div>

    @can('create', App\Models\Message::class)
        <div class="flex sm:justify-end sm:mt-4 ml-auto sm:ml-0">
            <x-link-as-button href="{{ route('messages.show', $user) }}">{{ __('Send Message') }}</x-link-as-button>
        </div>
    @endcan
</div>
