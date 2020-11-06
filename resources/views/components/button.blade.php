@props(['type' => 'button'])

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'font-medium px-4 py-2 rounded-md focus:shadow-outline focus:outline-none disabled:opacity-75']) }}>
    {{ $slot }}
</button>