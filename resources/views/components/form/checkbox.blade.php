@props(['checked' => false])

<input
    {{ $attributes->merge(['class' => 'form-checkbox']) }}
    type="checkbox"
    @if($checked) checked @endif
>