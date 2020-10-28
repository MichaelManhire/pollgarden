<x-app-layout>
    <x-slot name="title">{{ __('Messages with') }} {{ $user->name }} - Poll Garden</x-slot>

    <x-container>
        <x-page-heading class="mb-4">{{ __('Messages with') }} {{ $user->name }}</x-page-heading>

        <div class="mb-6">
            <x-message-form :user="$user" />
        </div>

        @if ($messages->count())
            <ol>
                @foreach ($messages as $message)
                    <li class="{{ $loop->first ?: 'mt-4' }}">
                        <x-message :message="$message" />
                    </li>
                @endforeach
            </ol>
        @endif

        <div class="pt-6">
            {{ $messages->onEachSide(0)->links() }}
        </div>
    </x-container>
</x-app-layout>
