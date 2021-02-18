@props(['checked' => false])

<input
    type="radio"
    {{ $attributes->merge(['class' => 'border-gray-300 rounded-full']) }}
    @if($checked) checked @endif
>