@props(['checked' => false])

<input
    type="checkbox"
    {{ $attributes->merge(['class' => 'rounded']) }}
    @if($checked) checked @endif
>