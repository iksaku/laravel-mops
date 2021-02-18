@props(['type' => 'text'])

<input
    type="{{ $type }}"
    {{ $attributes->merge(['class' => 'w-full border-gray-300 rounded-md']) }}
>