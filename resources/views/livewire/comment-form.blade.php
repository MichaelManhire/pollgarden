<form class="mt-3" wire:submit.prevent="submitComment">
    <x-form-field>
        <x-slot name="label">
            <label class="sr-only" for="comment">{{ __('Comment') }}</label>
        </x-slot>

        <x-slot name="control">
            <x-textarea
                id="comment"
                name="body"
                placeholder="Post a comment on this poll&hellip;"
                required
                maxlength="1000"
                rows="3"
                wire:model.defer="body"
            />
        </x-slot>
    </x-form-field>

    <x-form-actions>
        <x-button>{{ __('Post Comment') }}</x-button>
    </x-form-actions>
</form>
