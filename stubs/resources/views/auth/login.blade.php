@extends('layouts.auth')

@section('title', __('mops::auth.login'))
@section('action', route('login'))

@if(Route::has('register'))
    @section('subtitle')
        <a href="{{ route('register') }}" class="text-blue-700 hocus:text-blue-900">
            @lang('mops::auth.orRegister')
        </a>
    @endsection
@endif

@section('contents')
    <x-mops::form.label :name="__('mops::auth.email')">
        <x-mops::form.input
            autofocus
            required
            type="email"
            name="email"
            placeholder="user@example.com"
            value="{{ old('email') }}"
        />
        <x-mops::form.error for="email" />
    </x-mops::form.label>

    <x-mops::form.label :name="__('mops::auth.password')">
        <x-mops::form.input
            required
            type="password"
            name="password"
            placeholder="********"
        />
        <x-mops::form.error for="password" />
    </x-mops::form.label>

    <div class="w-full flex items-center justify-between">
        <x-mops::form.label class="inline-flex items-center text-sm font-medium space-x-2">
            <x-mops::form.checkbox
                name="remember"
                :checked="old('remember')"
            />
            <span>@lang('mops::auth.remember')</span>
        </x-mops::form.label>

        @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-blue-500 hover:text-blue-700 text-sm font-medium">
                @lang('mops::auth.forgotPassword')
            </a>
        @endif
    </div>

    <div class="w-full flex justify-center">
        <button class="w-full md:w-2/3 bg-blue-500 hocus:bg-blue-700 text-white font-bold focus:shadow-outline focus:outline-none px-4 py-2 rounded-md">
            @lang('mops::auth.login')
        </button>
    </div>
@endsection