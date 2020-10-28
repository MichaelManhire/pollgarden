<x-app-layout>
    <x-slot name="title">{{ __('Polls') }} - Poll Garden</x-slot>
    <x-slot name="description">{{ __('Ask questions, vote in polls, and engage with others at Poll Garden.') }}</x-slot>

    <x-container>
        <x-page-heading class="mb-4">{{ __('Polls') }}</x-page-heading>

        <x-poll-list :polls="$polls" />

        <div class="pt-6">
            {{ $polls->onEachSide(0)->links() }}
        </div>
    </x-container>
</x-app-layout>
