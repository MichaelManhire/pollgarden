<button {{ $attributes->merge(['class' => 'button button-secondary', 'type' => 'button']) }}>
    {{ $slot }}
</button>
