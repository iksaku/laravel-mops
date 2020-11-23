@props(['route', 'highlightChildren' => true])

<div class="-mx-2">
    <div class="contents @route($route, $highlightChildren) bg-gray-900 @else hover:bg-gray-900 focus-within:bg-gray-900 @endif">
        <a
            {{ $attributes->merge(['class' => 'flex items-center bg-inherit text-inherit focus:ring focus:outline-none p-2 rounded-md space-x-2 transition duration-100']) }}
            href="{{ Route::has($route) ? route($route) : $route }}"
        >
            {{ $slot }}
        </a>
    </div>
</div>
