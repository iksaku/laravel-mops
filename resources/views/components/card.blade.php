@props(['stretch' => false])

<div {{ $attributes->merge(['class' => 'bg-white border border-gray-300 sm:rounded-md space-y-4 overflow-hidden' . ($stretch ? '' : ' p-4')]) }}>
    {{ $slot }}
</div>
