<x-app-layout>
    <x-slot name="title">{{ __('Notifications') }} - Poll Garden</x-slot>

    <x-container>
        <x-page-heading class="mb-4">{{ __('Notifications') }}</x-page-heading>

        @if ($unreadNotifications->count() || $readNotifications->count())
            <ol>
                @foreach ($unreadNotifications as $notification)
                    <li class="my-4">
                        <x-notification :notification="$notification" is-read="{{ false }}" />
                    </li>
                @endforeach

                @foreach ($readNotifications as $notification)
                    <li class="my-4">
                        <x-notification :notification="$notification" is-read="{{ true }}"  />
                    </li>
                @endforeach
            </ol>
        @else
            <p>{{ __('You don\'t have any notifications at this time.') }}</p>
        @endif
    </x-container>
</x-app-layout>
