@props(['type' => 'text'])

<input
    {{ $attributes->merge(['class' => 'w-full form-input']) }}
    type="{{ $type }}"
>
