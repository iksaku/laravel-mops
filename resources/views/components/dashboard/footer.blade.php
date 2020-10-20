<div class="flex-shrink-0 w-full flex items-center justify-center">
    <span class="text-gray-700 text-sm font-medium">
        @if($slot->isNotEmpty())
            {{ $slot }}
        @else
            <a
                class="text-indigo-700 font-semibold"
                href="https://github.com/iksaku/laravel-mops"
                target="_blank"
            >
                Laravel MOPS
            </a>
            &middot; &copy; 2020 Jorge González
        @endif
    </span>
</div>