@props(['active'])

<div class="-mx-2">
    <div class="contents @if($active) bg-gray-900 @else hover:bg-gray-900 focus-within:bg-gray-900 @endif">
        <a {{ $attributes->merge(['class' => 'block bg-inherit text-inherit focus:shadow-outline focus:outline-none p-2 rounded-md space-x-2 transition duration-100']) }}>
            {{ $slot }}
        </a>
    </div>
</div>
