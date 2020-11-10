@extends('layouts.auth')

@section('title', __('mops::auth.email.verification.title'))

@section('action', route('verification.send'))
@section('submit', __('mops::auth.email.verification.submit'))

@section('contents')
    @if(session()->get('status') === 'verification-link-sent')
        <div class="-m-4 mb-0 sm:-mx-6">
            <x-mops::alert
                    class="text-center rounded-b-none"
                    type="success"
                    :message="__('mops::auth.email.verification.sent')"
                    :closeable="false"
            />
        </div>
    @endif

    <p class="text-center">
        @lang('mops::auth.email.verification.description')
    </p>
@endsection