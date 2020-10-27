@props(['name' => null])

<label {{ $attributes->merge(['class' => 'block' . ($name ? ' space-y-2' : '')]) }}>
    @if($name)
        <div class="font-medium">
            {{ $name }}
        </div>
    @endif

    {{ $slot }}
</label>
