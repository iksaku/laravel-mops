@extends('layouts.auth')

@section('title', __('mops::auth.password.confirm.title'))

@section('description')
    @lang('mops::auth.password.confirm.description')
@endsection

@section('action', route('password.confirm'))
@section('submit', __('mops::auth.login.action'))

@section('contents')
    <x-mops::form.label :name="__('mops::auth.fields.password')">
        <x-mops::form.input
                required
                name="password"
                type="password"
                autocomplete="current-password"
                placeholder="*********"
        />
        <x-mops::form.error for="password" />
    </x-mops::form.label>
@endsection