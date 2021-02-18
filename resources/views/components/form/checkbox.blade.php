@props(['checked' => false])

<input
    type="checkbox"
    {{ $attributes->merge(['class' => 'border-gray-300 rounded']) }}
    @if($checked) checked @endif
>