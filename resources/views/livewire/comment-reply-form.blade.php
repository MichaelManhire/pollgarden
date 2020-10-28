<x-form class="mt-3" method="POST" wire:submit.prevent="submitReply">
    <label class="sr-only" for="reply-{{ $parentComment->id }}">{{ __('Reply') }}</label>
    <div class="relative rounded-md shadow-sm">
        <textarea class="form-input block w-full"
                  id="reply-{{ $parentComment->id }}"
                  name="body"
                  placeholder="Post a reply to this comment&hellip;"
                  required
                  maxlength="1000"
                  rows="3"
                  @error('body')
                  aria-invalid="true"
                  aria-describedby="reply-{{ $parentComment->id }}-error"
                  @enderror
                  x-ref="reply{{ $parentComment->id }}"
                  wire:model.defer="body"></textarea>

        @error('body')
            <div class="absolute inset-y-0 right-0 pr-3 pt-3 flex items-start text-red-500 pointer-events-none">
                <x-icons.error />
            </div>
        @enderror
    </div>

    @error('body')
        <p class="mt-2 text-sm text-red-600" id="reply-{{ $parentComment->id }}-error">{{ $message }}</p>
    @enderror

    <div class="flex justify-end mt-3">
        <x-button>{{ __('Post Reply') }}</x-button>
    </div>
</x-form>
