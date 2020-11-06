<x-mops::button {{ $attributes->except('wire:target')->merge(['class' => 'relative flex items-center justify-center']) }}>
    <div
        wire:loading
        {{ $attributes->only('wire:target') }}
        class="absolute"
    >
        {{ $indicator }}
    </div>

    <div
        wire:loading.class="invisible"
        {{ $attributes->only('wire:target') }}
    >
        {{ $slot }}
    </div>
</x-mops::button>