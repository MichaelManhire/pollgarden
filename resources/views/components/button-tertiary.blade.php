<button {{ $attributes->merge([
    'class' => 'inline-block text-green-700 text-sm leading-5 hover:underline',
    'type' => 'button'
]) }}>
    {{ $slot }}
</button>
