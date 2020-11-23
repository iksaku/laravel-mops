<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @stack('meta')

        {{-- Title --}}
        @hasSection('title')
            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        {{-- Favicon --}}
        <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">

        {{-- Inter Font --}}
        <link rel="dns-prefetch" href="https://rsms.me">
        <link rel="preconnect" href="https://rsms.me">
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

        {{-- More Styles if needed --}}
        @stack('styles')
    </head>

    <body class="bg-white text-gray-900">
        @yield('body')

        @stack('modals')

        @stack('scripts')
    </body>
</html>
