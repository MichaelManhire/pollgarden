@props(['user'])

<a class="group block w-56 bg-white overflow-hidden shadow rounded-lg hover:bg-gray-50 base-transition" href="{{ route('users.show', $user) }}">
    <div class="px-2 py-2.5 sm:p-3">
        <x-media-object class="items-center">
            <x-slot name="media">
                <x-avatar :user="$user" />
            </x-slot>

            <x-slot name="body">
                <p class="text-sm leading-5 font-medium text-gray-700 group-hover:text-gray-900">{{ $user->name }}</p>
                <x-user-badge :user="$user" />
            </x-slot>
        </x-media-object>
    </div>
</a>
