@props(['user'])

@if ($user->age || $user->gender || $user->country)
    <p class="inline-flex items-center px-1 py-0.5 rounded text-xs font-medium leading-4 bg-gray-100 text-gray-800">
        @if ($user->age)
            <span class="mx-0.5">
                {{ $user->age }}
            </span>
        @endif

        @if ($user->gender)
            <abbr class="mx-0.5" title="{{ $user->gender->name }}">
                {{ $user->gender->abbreviation }}
            </abbr>
        @endif

        @if ($user->country)
            <span class="mx-0.5">
                @if ($user->state)
                    <abbr title="{{ $user->state->name }}">
                        {{ $user->state->abbreviation }},
                    </abbr>
                @endif

                <abbr title="{{ $user->country->name }}">{{ $user->country->abbreviation }}</abbr>
            </span>
        @endif
    </p>
@endif
