<div
    x-data="{ show: true }"
    x-show="show"
    class="w-full flex items-center justify-between {{ $backgroundColor }} {{ $textColor }} border {{ $borderColor }} rounded-md mb-4 space-x-2"
>
    <div class="flex items-start p-4 space-x-2">
        @isset($icon)
            <div class="inline-block align-middle">
                {!! $icon !!}
            </div>
        @endisset

        <div class="text-sm sm:text-base">
            @isset($title)
                <div class="{{ $titleColor }} font-semibold">
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
            class="{{ $titleColor }} font-bold focus:outline-none p-4"
            @click="show = false"
        >
            &times;
        </button>
    @endif
</div>
