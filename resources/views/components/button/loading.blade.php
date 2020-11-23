<x-mops::button {{ $attributes->except('wire:target')->merge(['class' => 'relative flex items-center justify-center']) }}>
    <div
        wire:loading
        {{ $attributes->wire('target') }}
        class="absolute"
    >
        {{ $indicator }}
    </div>

    <div
        wire:loading.class="invisible"
        {{ $attributes->wire('target') }}
    >
        {{ $slot }}
    </div>
</x-mops::button>