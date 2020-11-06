@extends('layouts.auth')

@section('title', __('mops::auth.password.forgot.title'))

@section('description')
    @lang('mops::auth.password.forgot.description')
@endsection

@section('action', route('password.request'))
@section('submit', __('mops::auth.password.forgot.action'))

@section('contents')
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