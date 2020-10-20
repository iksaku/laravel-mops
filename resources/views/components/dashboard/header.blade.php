<div class="contents bg-white">
    <header {{ $attributes->merge(['class' => 'w-full bg-inherit shadow px-4 lg:px-8 py-2']) }}>
        <div class="container flex items-center justify-between mx-auto space-x-4">
            <div class="min-w-0 flex items-center text-xl lg:text-2xl font-bold">
                <button
                    x-data
                    @click="$dispatch('open-sidebar')"
                    class="lg:hidden text-gray-700 focus:outline-none mr-4"
                >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <div class="truncate">
                    @yield('title', 'Dashboard')
                </div>
            </div>

            {{ $slot }}
        </div>
    </header>
</div>
