<div class="contents bg-white">
    <header {{ $attributes->merge(['class' => 'w-full bg-inherit shadow px-4 lg:px-8 py-2']) }}>
        <div class="container flex items-center justify-between mx-auto space-x-4">
            <div class="min-w-0 flex items-center text-xl lg:text-2xl font-bold">
                <button
                    x-data
                    @click="$dispatch('open-sidebar')"
                    class="lg:hidden text-gray-700 focus:outline-none mr-4"
                >
                    @isset($sidebarIcon)
                        {{ $sidebarIcon }}
                    @else
                        <x-heroicon-s-menu class="w-6 h-6" />
                    @endisset
                </button>

                <div class="truncate">
                    @yield('title', 'Dashboard')
                </div>
            </div>

            @if($slot->isNotEmpty())
                {{ $slot }}
            @else
                <x-mops::dropdown class="origin-top-right right-0">
                    <x-slot name="trigger">
                        <button class="flex items-center font-medium space-x-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span class="hidden sm:inline">@lang('mops::auth.account')</span>
                        </button>
                    </x-slot>

                    <x-mops::auth.logout class="w-full hocus:bg-red-500 hocus:text-gray-100">
                        @lang('mops::auth.logout')
                    </x-mops::auth.logout>
                </x-mops::dropdown>
            @endif
        </div>
    </header>
</div>
