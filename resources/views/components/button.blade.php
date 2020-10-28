<button {{ $attributes->merge(['class' => 'button button-primary', 'type' => 'submit']) }}>
    {{ $slot }}
</button>
