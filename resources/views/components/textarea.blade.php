<div>
    <div class="mt-1 relative rounded-md shadow-sm">
        <textarea
            {{ $attributes->merge(['class' => 'form-input block w-full']) }}
            @error($name)
            aria-invalid="true"
            aria-describedby="{{ $id }}-error"
            @enderror
        >{{ $slot }}</textarea>

        @error($name)
            <div class="absolute inset-y-0 right-0 pr-3 pt-3 flex items-start text-red-500 pointer-events-none">
                <x-icons.error />
            </div>
        @enderror
    </div>

    @error($name)
        <p class="mt-2 text-sm text-red-600" id="{{ $id }}-error">{{ $message }}</p>
    @enderror
</div>
