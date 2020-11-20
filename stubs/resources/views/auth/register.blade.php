@extends('layouts.auth')

@section('title', __('mops::auth.register.title'))

@if(Route::has('login'))
    @section('subtitle')
        <a href="{{ route('login') }}" class="text-blue-500 hocus:text-blue-700 focus:ring focus:outline-none">
            @lang('mops::auth.login.option')
        </a>
    @endsection
@endif

@section('action', route('register'))
@section('submit', __('mops::auth.register.submit'))

@section('contents')
    <x-mops::form.label :name="__('mops::auth.fields.name')">
        <x-mops::form.input
            autofocus
            required
            name="name"
            type="text"
            autocomplete="name"
            placeholder="John Doe"
            value="{{ old('name') }}"
        />
        <x-mops::form.error for="name"/>
    </x-mops::form.label>

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
            autocomplete="new-password"
            placeholder="********"
        />
        <x-mops::form.error for="password"/>
    </x-mops::form.label>

    <x-mops::form.label :name="__('mops::auth.fields.password-confirmation')">
        <x-mops::form.input
            required
            name="password_confirmation"
            type="password"
            autocomplete="new-password"
            placeholder="********"
        />
        <x-mops::form.error for="password_confirmation"/>
    </x-mops::form.label>
@endsection