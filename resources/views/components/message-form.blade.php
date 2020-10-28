@props(['user'])

<x-form action="{{ route('messages.store') }}" method="POST">
    <input name="recipient_id" type="hidden" value="{{ $user->id }}">

    <x-form-field>
        <x-slot name="label">
            <label class="sr-only" for="message">{{ __('Message') }}</label>
        </x-slot>

        <x-slot name="control">
            <x-textarea
                id="message"
                name="body"
                placeholder="Send a message to {{ $user->name }}&hellip;"
                required
                autofocus
                maxlength="1000"
                rows="3"
            />
        </x-slot>
    </x-form-field>

    <x-form-actions>
        <x-button>{{ __('Send Message') }}</x-button>
    </x-form-actions>
</x-form>
