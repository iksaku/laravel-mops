@extends('layouts.auth')

@section('title', __('mops::auth.password.confirm.title'))

@section('description')
    @lang('mops::auth.password.confirm.description')
@endsection

@section('action', route('password.confirm'))

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

    <div class="w-full flex justify-center">
        <button class="w-full md:w-2/3 bg-blue-500 hocus:bg-blue-700 text-white font-bold focus:shadow-outline focus:outline-none px-4 py-2 rounded-md">
            @lang('mops::auth.login.action')
        </button>
    </div>
@endsection