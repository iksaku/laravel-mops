@props(['event', 'title' => null])

<x-mops::include.component.open-close />

<div
    x-cloak
    x-data="{ ...mopsComponentOpenClose(), ...{{ $attributes->get('x-data', '{}') }} }"
    x-show="isOpen"
    {{ "@{$event}" }}.window="open($event)"
    wire:key="{{ $event }}-modal"
    role="dialog"
>
    <div class="fixed z-10 inset-x-0 bottom-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center">
        <div
            class="fixed inset-0"

            @click="close()"

            x-show="isOpen"
            x-transition:enter="transition-opacity ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <div class="fixed inset-0 bg-black opacity-50"></div>
        </div>

        <x-mops::card
            {{
                $attributes->except('x-data')->merge([
                    'class' => 'relative w-full max-w-md rounded-md',
                    'x-show' => 'isOpen',
                    'x-transition:enter' => 'transform ease-out duration-200',
                    'x-transition:enter-start' => 'translate-y-full sm:translate-y-0 sm:scale-95 sm:opacity-0',
                    'x-transition:enter-end' => 'sm:scale-100 sm:opacity-100',
                    'x-transition:leave' => 'transform ease-in duration-200',
                    'x-transition:leave-start' => 'sm:scale-100 sm:opacity-100',
                    'x-transition:leave-end' => 'translate-y-full sm:translate-y-0 sm:scale-95 sm:opacity-0'
                ])
            }}
        >
            <div class="-mx-4 sm:-mx-6">
                <div class="flex items-center justify-between px-4 sm:px-6">
                    <div class="font-semibold leading-none">
                        @isset($title)
                            {{ $title }}
                        @endisset
                    </div>

                    <button
                        class="text-gray-400 hocus:text-red-500 text-2xl font-bold leading-none focus:ring focus:outline-none"
                        @click="close()"
                    >
                        &times;
                    </button>
                </div>

                <div class="px-4 sm:px-6">
                    {{ $slot }}
                </div>

                @isset($footer)
                    <div class="px-4 sm:px-6">
                        {{ $footer }}
                    </div>
                @endisset
            </div>
        </x-mops::card>
    </div>
</div>
