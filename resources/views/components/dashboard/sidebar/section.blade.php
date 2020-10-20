@props(['name' => null])

<div>
    @isset($name)
        <span {{ $attributes->merge(['class' => 'text-gray-500 text-xs font-bold uppercase tracking-wide']) }}>
            {{ $name }}
        </span>
    @endisset

    <div class="space-y-2">
        {{ $slot }}
    </div>
</div>