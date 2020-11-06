@extends('layouts.auth')

@section('title', __('mops::auth.2fa.title'))

@section('description')
    <span x-show="!recovery">
        @lang('mops::auth.2fa.description.otp')
    </span>
    <span x-show="recovery">
        @lang('mops::auth.2fa.description.recovery-code')
    </span>
@endsection

@section('action', route('two-factor.login'))
@section('submit', __('mops::auth.login.action'))
@section('x-data', '{ recovery: false }')

@section('contents')
    <div>
        <x-mops::form.label :name="__('mops::auth.fields.otp')" x-show="!recovery">
            <x-mops::form.input
                    autofocus
                    required
                    name="code"
                    type="text"
                    inputmode="numeric"
                    autocomplete="one-time-code"
            />
            <x-mops::form.error for="code" />
        </x-mops::form.label>

        <x-mops::form.label :name="__('mops::auth.fields.recovery-code')" x-show="recovery">
            <x-mops::form.input
                    autofocus
                    required
                    name="recovery_code"
                    type="text"
                    autocomplete="one-time-code"
            />
            <x-mops::form.error for="recovery_code" />
        </x-mops::form.label>
    </div>

    <div class="w-full text-center">
        <button
                x-show="recovery"
                @click="recovery = false"
                type="button"
                class="text-blue-500 hocus:text-blue-700 font-medium focus:outline-none"
        >
            @lang('mops::auth.2fa.options.otp')
        </button>

        <button
                x-show="!recovery"
                @click="recovery = true"
                type="button"
                class="text-blue-500 hocus:text-blue-700 font-medium focus:outline-none"
        >
            @lang('mops::auth.2fa.options.recovery-code')
        </button>
    </div>
@endsection