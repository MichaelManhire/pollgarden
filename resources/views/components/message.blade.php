@props(['message'])

<article x-data="{ isEditing: false }">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <x-media-object>
                <x-slot name="media">
                    <a href="{{ route('users.show', $message->sender) }}">
                        <x-avatar :user="$message->sender" />
                    </a>
                </x-slot>

                <x-slot name="body">
                    <h2 class="text-lg font-semibold">
                        <a class="hover:underline" href="{{ route('users.show', $message->sender) }}">
                            {{ $message->sender->name }}
                        </a>
                    </h2>
                    <p class="mt-2">{{ $message->body }}</p>
                </x-slot>
            </x-media-object>
        </div>

        <div class="border-t border-gray-200 px-4 py-4 sm:px-6">
            <div class="flex justify-between items-center">
                <x-byline :time="$message->created_at" />

                <div class="ml-auto">
                    @can('update', $message)
                        <x-button-tertiary
                            class="ml-2"
                            x-text="isEditing ? 'Cancel' : 'Edit'"
                            x-on:click="isEditing = !isEditing; $nextTick(() => $refs.edit{{ $message->id }}.focus())"
                        />
                    @endcan

                    @can('delete', $message)
                        <x-form
                            class="inline-block ml-2"
                            action="{{ route('messages.destroy', $message->id) }}"
                            method="DELETE"
                            x-data="{ isOpen: false }"
                        >
                            <x-button-tertiary type="button" x-on:click="isOpen = true">{{ __('Delete') }}</x-button-tertiary>

                            <x-modal :id="$message->id">
                                <x-slot name="heading">{{ __('Delete Message') }}</x-slot>
                                <x-slot name="body">{{ __('Are you sure you want to delete your message?') }}</x-slot>
                                <x-slot name="primary">{{ __('Delete Message') }}</x-slot>
                                <x-slot name="secondary">{{ __('Cancel') }}</x-slot>
                            </x-modal>
                        </x-form>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    @can('update', $message)
        <div x-show="isEditing">
            <x-message-edit-form :message="$message" />
        </div>
    @endcan
</article>
