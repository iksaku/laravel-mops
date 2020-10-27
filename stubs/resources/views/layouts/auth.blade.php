@extends('layouts.base')

@section('body')
    <div class="w-full min-h-screen flex flex-col bg-gray-200">
        @auth
            {{-- TODO: Auth Header --}}
        @endauth

        <div class="w-full flex-grow flex flex-col items-center justify-center sm:px-4 py-4 lg:px-8 space-y-8">
            <div class="text-center space-y-2">
                <h1 class="text-4xl text-center font-bold px-4 sm:px-0">
                    @hasSection('message')
                        @yield('message')
                    @else
                        @yield('title')
                    @endif
                </h1>

                @hasSection('subtitle')
                    <h2 class="text-lg text-center font-medium px-4 sm:px-0">
                        @yield('subtitle')
                    </h2>
                @endif
            </div>

            <form action="@yield('action')" method="@yield('method', 'POST')" class="w-full sm:max-w-sm">
                @csrf

                <x-mops::card>
                    @yield('contents')
                </x-mops::card>
            </form>
        </div>
    </div>
@endsection