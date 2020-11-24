@extends('layouts.base')

<x-mops::include.alpine />

@section('body')
    <div class="w-full min-h-screen flex flex-col bg-gray-100">
        @auth
            <x-mops::auth.header />
        @endauth

        <div
            x-data="@yield('x-data', '{}')"
            class="w-full flex-grow flex flex-col items-center justify-start sm:px-4 lg:px-8 py-4 space-y-8"
        >
            <div class="w-full sm:max-w-md flex flex-col items-center text-center space-y-2 px-4 sm:px-0">
                <x-logo class="h-24" />

                <h1 class="text-4xl font-bold">
                    @yield('title')
                </h1>

                @hasSection('subtitle')
                    <h2 class="text-xl font-medium">
                        @yield('subtitle')
                    </h2>
                @endif

                @hasSection('description')
                    <p class="font-medium">
                        @yield('description')
                    </p>
                @endif
            </div>

            <form action="@yield('action')" method="@yield('method', 'POST')" class="w-full sm:max-w-sm">
                @csrf

                @yield('hidden_values')

                <x-mops::card>
                    @yield('contents')

                    <div class="w-full flex justify-center">
                        <x-mops::button type="submit" class="w-full bg-blue-500 hocus:bg-blue-700 text-white font-bold">
                            @yield('submit')
                        </x-mops::button>
                    </div>
                </x-mops::card>
            </form>
        </div>
    </div>
@endsection