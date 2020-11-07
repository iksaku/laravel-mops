@extends('layouts.auth')

@section('title', __('mops::auth.login.title'))

@if(Route::has('register'))
    @section('subtitle')
        <a href="{{ route('register') }}" class="text-blue-500 hocus:text-blue-700">
            @lang('mops::auth.register.option')
        </a>
    @endsection
@endif

@section('action', route('login'))
@section('submit', __('mops::auth.login.action'))

@section('contents')
    @if(session()->get('status', false))
        <div class="-m-4 mb-0 sm:-mx-6">
            <x-mops::alert
                    class="text-center rounded-b-none"
                    type="success"
                    :message="session()->get('status')"
                    :closeable="false"
            />
        </div>
    @endif

    <x-mops::form.label :name="__('mops::auth.fields.email')">
        <x-mops::form.input
                autofocus
                required
                name="email"
                type="email"
                autocomplete="email"
                placeholder="user@example.com"
                value="{{ old('email') }}"
        />
        <x-mops::form.error for="email"/>
    </x-mops::form.label>

    <x-mops::form.label :name="__('mops::auth.fields.password')">
        <x-mops::form.input
                required
                name="password"
                type="password"
                autocomplete="current-password"
                placeholder="********"
        />
        <x-mops::form.error for="password"/>
    </x-mops::form.label>

    <div class="w-full flex items-center justify-between">
        <x-mops::form.label class="inline-flex items-center text-sm font-medium space-x-2">
            <x-mops::form.checkbox
                    name="remember"
                    :checked="old('remember')"
            />
            <span>@lang('mops::auth.fields.remember')</span>
        </x-mops::form.label>

        @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-blue-500 hover:text-blue-700 text-sm font-medium">
                @lang('mops::auth.password.forgot.option')
            </a>
        @endif
    </div>
@endsection