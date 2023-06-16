@extends('layout.index')
@section('content')
<form class="form" method="POST">
    @csrf
    <div class="title">{{ __('message.sign_up') }}</div>
    <div class="form-group row">
        <label for="name" class="label">{{ __('message.username') }}<span class="required">*</span></label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
    </div>
    <div class="form-group row">
        <label for="email" class="label">{{ __('message.email') }} <span class="required">*</span></label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
    </div>
    <div class="form-group row">
        <label for="password" class="label">{{ __('message.password') }} <span class="required">*</span></label>
        <input type="password" name="password" id="password">
    </div>
    <div class="form-group row">
        <label for="confirm_password" class="label">{{ __('message.password_confirm') }}<span class="required">*</span></label>
        <input type="password" name="confirm_password" id="confirm-password">
        @error('name')
            <span class="error">{{ $message }}</span>
        @enderror
        @error('email')
        <span class="error">{{ $message }}</span>
        @enderror
        @error('password')
        <span class="error">{{ $message }}</span>
        @enderror
        @error('confirm_password')
        <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-button row">
        <button>{{ __('message.sign_up') }}</button>
    </div>
    <div class="form-rq-link row">
        <a href="{{ route('login') }}">{{ __('message.login_here') }}</a>
    </div>
</form>
@endsection
