<x-app-layout>
    <x-slot name="title">{{ __('Create a Poll') }} - Poll Garden</x-slot>

    <x-container>
        <x-panel>
            <div class="mb-4">
                <x-page-heading>{{ __('Create a Poll') }}</x-page-heading>
                <p class="mt-1 text-sm text-gray-500">{{ __('Your poll will be placed in the list of polls and voted on by the Poll Garden community.') }}</p>
            </div>

            <x-form action="{{ route('polls.store') }}" method="POST" enctype="multipart/form-data">
                <x-form-field>
                    <x-slot name="label">
                        <x-label for="title">{{ __('Title') }}</x-label>
                    </x-slot>
                    <x-slot name="control">
                        <x-input
                            id="title"
                            name="title"
                            type="text"
                            value="{{ old('title') }}"
                            required
                            autofocus
                            autocomplete="off"
                            minlength="5"
                            maxlength="80"
                        />
                    </x-slot>
                </x-form-field>

                <fieldset class="mt-4">
                    <legend class="block text-sm font-medium leading-5 text-gray-700">{{ __('Options') }}</legend>

                    <x-form-field>
                        <x-slot name="label">
                            <x-label class="sr-only" for="option0">{{ __('Option 1') }}</x-label>
                        </x-slot>
                        <x-slot name="control">
                            <x-input
                                id="option0"
                                name="options[0][name]"
                                type="text"
                                value="{{ old('options.0.name') }}"
                                placeholder="Option 1"
                                required
                                autocomplete="off"
                                maxlength="80"
                            />
                        </x-slot>
                    </x-form-field>

                    <x-form-field>
                        <x-slot name="label">
                            <x-label class="sr-only" for="option1">{{ __('Option 2') }}</x-label>
                        </x-slot>
                        <x-slot name="control">
                            <x-input
                                id="option1"
                                name="options[1][name]"
                                type="text"
                                value="{{ old('options.1.name') }}"
                                placeholder="Option 2"
                                required
                                autocomplete="off"
                                maxlength="80"
                            />
                        </x-slot>
                    </x-form-field>

                    <x-form-field>
                        <x-slot name="label">
                            <x-label class="sr-only" for="option2">{{ __('Option 3 (not required)') }}</x-label>
                        </x-slot>
                        <x-slot name="control">
                            <x-input
                                id="option2"
                                name="options[2][name]"
                                type="text"
                                value="{{ old('options.2.name') }}"
                                placeholder="Option 3 (not required)"
                                autocomplete="off"
                                maxlength="80"
                            />
                        </x-slot>
                    </x-form-field>

                    <x-form-field>
                        <x-slot name="label">
                            <x-label class="sr-only" for="option3">{{ __('Option 4 (not required)') }}</x-label>
                        </x-slot>
                        <x-slot name="control">
                            <x-input
                                id="option3"
                                name="options[3][name]"
                                type="text"
                                value="{{ old('options.3.name') }}"
                                placeholder="Option 4 (not required)"
                                autocomplete="off"
                                maxlength="80"
                            />
                        </x-slot>
                    </x-form-field>

                    <x-form-field>
                        <x-slot name="label">
                            <x-label class="sr-only" for="option4">{{ __('Option 5 (not required)') }}</x-label>
                        </x-slot>
                        <x-slot name="control">
                            <x-input
                                id="option4"
                                name="options[4][name]"
                                type="text"
                                value="{{ old('options.4.name') }}"
                                placeholder="Option 5 (not required)"
                                autocomplete="off"
                                maxlength="80"
                            />
                        </x-slot>
                    </x-form-field>
                </fieldset>

                <x-form-field class="mt-4">
                    <x-slot name="label">
                        <x-label for="category">{{ __('Category') }}</x-label>
                    </x-slot>
                    <x-slot name="control">
                        <x-select
                            id="category"
                            name="category_id"
                            required
                        >
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-select>
                    </x-slot>
                </x-form-field>

                <div class="mt-4" x-data="{ photoName: null, photoPreview: null }">
                    <x-label for="image">{{ __('Image (not required)') }}</x-label>
                    <input
                        class="hidden"
                        id="image"
                        name="image"
                        type="file"
                        accept="image/*"
                        @error('image')
                        aria-invalid="true"
                        aria-describedby="image-error"
                        @enderror
                        x-ref="photo"
                        x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.photo.files[0]);
                        "
                    >

                    <div class="mt-2" x-show="photoPreview">
                        <span
                            class="block rounded-full w-20 h-20"
                            x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <x-button-secondary class="mt-2" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Upload Image') }}
                    </x-button-secondary>

                    @error('image')
                        <p class="mt-2 text-sm text-red-600" id="image-error">{{ $message }}</p>
                    @enderror
                </div>

                <x-form-actions>
                    <x-button>{{ __('Create Poll') }}</x-button>
                </x-form-actions>
            </x-form>
        </x-panel>
    </x-container>
</x-app-layout>
