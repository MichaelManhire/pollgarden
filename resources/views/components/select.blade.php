<div>
    <div class="mt-1 relative rounded-md shadow-sm">
        <select
            {{ $attributes->merge(['class' => 'mt-1 form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:shadow-outline-green focus:border-green-300 sm:text-sm sm:leading-5']) }}
            @error($name)
            aria-invalid="true"
            aria-describedby="{{ $id }}-error"
            @enderror
        >
            {{ $slot }}
        </select>

        @error($name)
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-red-500 pointer-events-none">
                <x-icons.error />
            </div>
        @enderror
    </div>

    @error($name)
        <p class="mt-2 text-sm text-red-600" id="{{ $id }}-error">{{ $message }}</p>
    @enderror
</div>
