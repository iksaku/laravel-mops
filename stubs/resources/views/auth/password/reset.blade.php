@extends('layouts.auth')

@section('title', __('mops::auth.password.reset.title'))

@section('description', __('mops::auth.password.reset.description'))

@section('action', route('password.update'))
@section('submit', __('mops::auth.password.reset.submit'))

@section('hidden_values')
    <input type="hidden" name="token" value="{{ $request->route('token') }}">
@endsection

@section('contents')
    <x-mops::form.label :name="__('mops::auth.fields.email')">
        <input
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
        <input
            required
            name="password"
            type="password"
            autocomplete="new-password"
            placeholder="********"
        />
        <x-mops::form.error for="password"/>
    </x-mops::form.label>

    <x-mops::form.label :name="__('mops::auth.fields.password-confirmation')">
        <input
            required
            name="password_confirmation"
            type="password"
            autocomplete="new-password"
            placeholder="********"
        />
        <x-mops::form.error for="password_confirmation"/>
    </x-mops::form.label>
@endsection