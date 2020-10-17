@props(['event'])

<div
    x-cloak
    x-data="{ ...mopsDefaultModalData(), ...{{ $attributes->get('x-data', '{}') }} }"
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
            <div class="fixed inset-0 bg-gray-500 opacity-50"></div>
        </div>

        <x-mops::card
            {{ $attributes->except('x-data')->merge(['class' => 'relative']) }}

            x-show="isOpen"
            x-transition:enter="transform transition-all ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transform transition-all ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
            <div class="divide-y divide-gray-200 -m-4 sm:-mx-6">
                <div class="flex items-center justify-between p-4 sm:px-6">
                    <div class="text-lg font-semibold">
                        @isset($title)
                            {{ $title }}
                        @endisset
                    </div>

                    <button
                        class="text-gray-400 hocus:text-red-500 text-2xl font-bold leading-none focus:shadow-outline-red focus:outline-none"
                        @click="close()"
                    >
                        &times;
                    </button>
                </div>

                <div class="p-4 sm:px-6">
                    {{ $slot }}
                </div>

                @isset($footer)
                    <div class="p-4 sm:px-6">
                        {{ $footer }}
                    </div>
                @endisset
            </div>
        </x-mops::card>
    </div>
</div>

@once
    @push('scripts')
        <script>
            function mopsDefaultModalData() {
                return {
                    isOpen: false,

                    open(event) {
                        this.isOpen = true
                        this.onOpen(event)
                    },
                    onOpen(event) {},

                    close(event) {
                        this.isOpen = false
                        this.onClose(event);
                    },
                    onClose(event) {}
                }
            }
        </script>
    @endpush
@endonce
