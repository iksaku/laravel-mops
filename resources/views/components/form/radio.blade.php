@props(['checked' => false])

<input
    type="radio"
    {{ $attributes->merge(['class' => 'rounded-full']) }}
    @if($checked) checked @endif
>