@props(['checked' => false])

<input
    type="checkbox"
    {{ $attributes->merge(['class' => 'border-gray-300 focus:border-transparent focus:ring rounded']) }}
    @if($checked) checked @endif
>