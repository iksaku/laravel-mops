<x-mops::dashboard.sidebar>
    <x-mops::dashboard.sidebar.section>
        <x-mops::dashboard.sidebar.link
                href="/"
                :active="in_route('dashboard.index')"
        >
            Dashboard
        </x-mops::dashboard.sidebar.link>
    </x-mops::dashboard.sidebar.section>

    <x-mops::dashboard.sidebar.section name="Control">
    </x-mops::dashboard.sidebar.section>
</x-mops::dashboard.sidebar>