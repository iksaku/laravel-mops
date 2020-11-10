@extends('layouts.base')

<x-mops::include.alpine />

@section('body')
    <div class="relative w-full min-h-screen flex">
        <x-dashboard.sidebar />

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
