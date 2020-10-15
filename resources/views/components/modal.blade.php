@props(['event'])

<div
    x-cloak
    x-data="{ ...mopsDefaultModalData(), ...{{ $attributes->get('x-data', '{}') }} }"
    x-show="isOpen"
    {{ "@{$event}" }}.window="open($event)"
    wire:key="{{ $event }}-modal"
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

        <div
            {{ $attributes->except('x-data')->merge(['class' => 'relative sm:w-full sm:max-w-lg bg-white rounded-md shadow-xl overflow-hidden']) }}

            x-show="isOpen"
            x-transition:enter="transform transition-all ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transform transition-all ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
            <button
                @click="close()"
                class="absolute top-1 right-2 text-gray-400 hocus:text-red-500 focus:shadow-outline-red focus:outline-none"
            >
                <span class="fas fa-times"></span>
            </button>

            <div class="bg-white px-4 pt-4 pb-2 sm:px-6">
                {{ $slot }}
            </div>
        </div>
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
