@extends('layout.index')
@section('content')
    <form class="form" action="{{ route('post.login') }}" method="POST">
        @csrf
        <div class="title">{{ __('message.sign_in') }}</div>
        <input type="hidden" name="status" value="1">
        <div class="form-group row">
            <label for="email" class="label">{{ __('message.username_email') }}<span class="required">*</span></label>
            <input type="email" name="email" id="email" autocomplete="false" value="{{ old('email') }}">
        </div>
        <div class="form-group row">
            <label for="password" class="label">{{ __('message.password') }} <span class="required">*</span></label>
            <input type="password" name="password" id="password" autocomplete="false">
            @error('email')
            <span class="error">{{ $message }}</span>
            @enderror
            @error('password')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-space-between">
            <div class="remember row">
                <input type="checkbox" name="remember" id="remember_id"><label for="remember_id">{{ __('message.remember_password') }}</label>
            </div>
            <a href="{{ route('forgot.password') }}">{{ __('message.forgot_your_password') }}</a>
        </div>
        <div class="form-button row">
            <button>{{ __('message.login') }}</button>
        </div>
        <div class="form-rq-link row">
            <a href="{{ route('register') }}">{{ __('message.sign_up_here') }}</a>
        </div>
    </form>
@endsection
