<x-app-layout>
    <x-slot name="title">{{ __('Messages') }} - Poll Garden</x-slot>

    <x-container>
        <x-page-heading class="mb-4">{{ __('Messages') }}</x-page-heading>

        @if ($messages->count())
            <ol>
                @foreach ($messages as $message)
                    <li class="{{ $loop->first ?: 'mt-4' }}">
                        <x-message-notification :message="$message" is-read="{{ $message->read() }}" />
                    </li>
                @endforeach
            </ol>
        @else
            <p>{{ __('You don\'t have any messages at this time.') }}</p>
        @endif

        <div class="pt-6">
            {{ $messages->onEachSide(0)->links() }}
        </div>
    </x-container>
</x-app-layout>
