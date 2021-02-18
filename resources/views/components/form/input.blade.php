@props(['type' => 'text'])

<input
    type="{{ $type }}"
    {{ $attributes->merge(['class' => 'w-full border-gray-300 focus:border-transparent focus:ring rounded-md']) }}
>