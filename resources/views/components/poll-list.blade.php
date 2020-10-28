@props(['polls'])

<ol {{ $attributes->merge(['class' => 'bg-white shadow overflow-hidden sm:rounded-md']) }}>
    @if ($polls->count())
        @foreach ($polls as $poll)
            <li class="{{ $loop->first ?: 'border-t border-gray-200' }}">
                <x-poll :poll="$poll" />
            </li>
        @endforeach
    @endif
</ol>
