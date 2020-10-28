<x-form class="mt-3" method="PUT" wire:submit.prevent="updateComment">
    <label class="sr-only" for="reply-{{ $comment->id }}">{{ __('Edit Comment') }}</label>
    <div class="relative rounded-md shadow-sm">
        <textarea class="form-input block w-full"
                  id="edit-{{ $comment->id }}"
                  name="body"
                  placeholder="Edit your comment&hellip;"
                  required
                  maxlength="1000"
                  rows="3"
                  @error('body')
                  aria-invalid="true"
                  aria-describedby="edit-{{ $comment->id }}-error"
                  @enderror
                  x-ref="edit{{ $comment->id }}"
                  wire:model.defer="body"></textarea>

        @error('body')
            <div class="absolute inset-y-0 right-0 pr-3 pt-3 flex items-start text-red-500 pointer-events-none">
                <x-icons.error />
            </div>
        @enderror
    </div>

    @error('body')
        <p class="mt-2 text-sm text-red-600" id="edit-{{ $comment->id }}-error">{{ $message }}</p>
    @enderror

    <div class="flex justify-end mt-3">
        <x-button>{{ __('Update Comment') }}</x-button>
    </div>
</x-form>
