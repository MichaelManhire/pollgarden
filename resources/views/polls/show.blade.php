<x-app-layout>
    <x-slot name="title">{{ $poll->title }} - Poll Garden</x-slot>
    <x-slot name="description">
        @if ($poll->category->id === 1)
            {{ __('Vote and engage with others on interesting questions.') }}
        @else
            {{ __('Vote and engage with others on interesting questions about') }} {{ strtolower($poll->category->name) }}.
        @endif
    </x-slot>

    <x-container>
        @livewire('ballot-box', ['poll' => $poll])

        <section class="mt-6">
            <x-section-heading>{{ __('Comments') }}</x-section-heading>

            @can('create', App\Models\Comment::class)
                @livewire('comment-form', ['poll' => $poll])
            @endcan

            @livewire('comment-list', ['poll' => $poll])
        </section>
    </x-container>
</x-app-layout>
