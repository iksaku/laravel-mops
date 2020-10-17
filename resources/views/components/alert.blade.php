<div
    x-data="{ show: true }"
    x-show="show"
    class="w-full flex items-center justify-between {{ $backgroundColor }} {{ $textColor }} border {{ $borderColor }} p-4 sm:px-6 rounded-md mb-4 space-x-2"
    role="alert"
>
    <div class="flex items-start space-x-2">
        @isset($icon)
            <div class="inline-block align-middle">
                {!! $icon !!}
            </div>
        @endisset

        <div class="text-sm sm:text-base">
            @isset($title)
                <div class="font-semibold">
                    {{ $title }}
                </div>
            @endif

            <div>
                @isset($message)
                    {!! $message !!}
                @else
                    {{ $slot }}
                @endisset
            </div>
        </div>
    </div>

    @if($closeable)
        <button
            @click="show = false"
            class="text-2xl font-bold leading-none focus:outline-none"
        >
            &times;
        </button>
    @endif
</div>
