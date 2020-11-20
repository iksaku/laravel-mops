@if($closeable)
    <x-mops::include.alpine />
@endif

<div
    x-data="{ show: true }"
    x-show="show"
    {{ $attributes->merge(['class' => "flex items-center justify-between {$backgroundColor} {$textColor} border {$borderColor} px-4 py-2 rounded-md mb-4 space-x-4"]) }}
    role="alert"
>
    <div class="flex-grow flex items-start space-x-2">
        @isset($icon)
            <div class="flex-shrink-0 inline-block align-middle">
                {!! $icon !!}
            </div>
        @endisset

        <div class="flex-grow text-sm sm:text-base">
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
            class="flex-shrink-0 text-2xl font-bold leading-none focus:outline-none"
        >
            &times;
        </button>
    @endif
</div>
