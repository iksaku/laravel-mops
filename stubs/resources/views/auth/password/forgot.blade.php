@extends('layouts.auth')

@section('title', __('mops::auth.password.forgot.title'))

@section('description', __('mops::auth.password.forgot.description'))

@section('action', route('password.email'))
@section('submit', __('mops::auth.password.forgot.action'))

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
        <x-mops::form.error for="email" />
    </x-mops::form.label>
@endsection