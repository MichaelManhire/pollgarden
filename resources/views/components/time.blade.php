@props(['time'])

<time datetime="{{ $time }}" title="{{ $time->toDayDateTimeString() }}" {{ $attributes }}>
    {{ $time->diffForHumans() }}
</time>
