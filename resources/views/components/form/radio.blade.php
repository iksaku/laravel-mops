@props(['checked' => false])

<input
    type="radio"
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-transparent focus:ring rounded-full']) }}
    @if($checked) checked @endif
>