@extends('layouts.base')

<x-mops::include.alpine />

@section('body')
    <div class="relative w-full min-h-screen flex">
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

        <div class="min-w-0 flex-grow flex flex-col">
            <x-mops::dashboard.header />

            <div class="h-full flex-grow flex flex-col sm:px-4 lg:px-8 py-4 space-y-4">
                <div class="container flex-grow flex mx-auto">
                    @yield('content')
                </div>

                <x-mops::dashboard.footer />
            </div>
        </div>
    </div>
@endsection
