<div
    x-data="{ isOpen: false }"
    {{-- This is a little hack to hide the sidebar on mobile before alpine initialization --}}
    x-init="$refs.sidebar.classList.remove('-translate-x-full')"
    class="contents bg-gray-800 text-gray-100"
    @open-sidebar.window="isOpen = true"
>
    <template x-if="isOpen">
        <div
            @click="isOpen = false"
            class="lg:hidden fixed z-30 inset-0 bg-black opacity-50"
        ></div>
    </template>

    <div
        x-ref="sidebar"
        :class="isOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
        {{ $attributes->merge(['class' => 'fixed lg:sticky z-40 lg:z-0 top-0 left-0 flex-shrink-0 self-start min-h-screen w-64 bg-inherit transform duration-200 -translate-x-full lg:translate-x-0']) }}
    >
        <div class="flex items-center justify-between text-2xl px-4 py-2">
            <div class="flex-grow lg:text-center font-bold">
                {{ config('app.name') }}
            </div>

            <button @click="isOpen = false" class="lg:hidden font-bold leading-none">
                &times;
            </button>
        </div>

        <nav class="font-medium p-4 space-y-8">
            {{ $slot }}
        </nav>
    </div>
</div>