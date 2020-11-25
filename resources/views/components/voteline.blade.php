@props(['color', 'option'])

<p {{ $attributes->merge(['class' => 'flex text-gray-500 text-sm leading-5']) }}>
    <span style="color: {{ $color }};">
        <x-icons.vote />
    </span>
    <span class="inline-block ml-1">
        {{ $option }}
    </span>
</p>
