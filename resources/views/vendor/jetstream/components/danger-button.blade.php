<button {{ $attributes->merge(['type' => 'button', 'class' => 'button button-danger']) }}>
    {{ $slot }}
</button>
