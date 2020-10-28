@props(['message'])

<x-form class="mt-3" action="{{ route('messages.update', $message) }}" method="PUT">
    <input name="recipient_id" type="hidden" value="{{ $message->recipient_id }}">

    <x-form-field>
        <x-slot name="label">
            <label class="sr-only" for="edit-message-{{ $message->id }}">{{ __('Edit Message') }}</label>
        </x-slot>

        <x-slot name="control">
            <x-textarea
                id="edit-message-{{ $message->id }}"
                name="body"
                placeholder="Edit your message&hellip;"
                required
                maxlength="1000"
                rows="3"
                x-ref="edit{{ $message->id }}"
            >
                {{ $message->body }}
            </x-textarea>
        </x-slot>
    </x-form-field>

    <x-form-actions>
        <x-button>{{ __('Update Message') }}</x-button>
    </x-form-actions>
</x-form>
