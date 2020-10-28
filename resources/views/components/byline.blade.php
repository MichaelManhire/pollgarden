@props(['author' => '', 'time', 'isLinked' => true])

<p {{ $attributes->merge(['class' => 'text-sm leading-5 text-gray-500']) }}>
    <span>
        @if ($author)
            {{ __('Posted by') }}
            @if ($isLinked)
                <x-link href="{{ route('users.show', $author) }}">{{ $author->name }}</x-link>
            @else
                {{ $author->name }}
            @endif
        @else
            {{ __('Posted') }}
        @endif
    </span>
    <x-time :time="$time" />
</p>
