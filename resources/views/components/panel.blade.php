<div {{ $attributes->merge(['class' => 'bg-white overflow-hidden shadow rounded-lg']) }}>
    <div class="px-4 py-5 sm:p-6">
        {{ $slot }}
    </div>
</div>
