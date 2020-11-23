@props(['type' => 'button'])

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'flex items-center font-medium px-4 py-2 rounded-md focus:ring focus:outline-none space-x-2 disabled:opacity-75']) }}>
    {{ $slot }}
</button>