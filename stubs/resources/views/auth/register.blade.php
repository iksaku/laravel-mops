@extends('layouts.auth')

@section('title', __('mops::auth.register'))
@section('action', route('register'))

@if(Route::has('login'))
    @section('subtitle')
        <a href="{{ route('login') }}" class="text-blue-700 hocus:text-blue-900">
            @lang('mops::auth.orLogin')
        </a>
    @endsection
@endif

@section('contents')
    <x-mops::form.label :name="__('mops::auth.name')">
        <x-mops::form.input
                autofocus
                required
                type="text"
                name="name"
                placeholder="John Doe"
                value="{{ old('name') }}"
        />
        <x-mops::form.error for="name" />
    </x-mops::form.label>

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

    <x-mops::form.label :name="__('mops::auth.confirmPassword')">
        <x-mops::form.input
                required
                type="password"
                name="password_confirmation"
                placeholder="********"
        />
        <x-mops::form.error for="password_confirmation" />
    </x-mops::form.label>

    <div class="w-full flex justify-center">
        <button class="w-full md:w-2/3 bg-blue-500 hocus:bg-blue-700 text-white font-bold focus:shadow-outline focus:outline-none px-4 py-2 rounded-md">
            @lang('mops::auth.register')
        </button>
    </div>
@endsection