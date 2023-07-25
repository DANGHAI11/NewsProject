@extends('layout.index')
@section('content')
    <form class="form" method="POST" action="{{ route('user.update.password', ['user' => $user]) }}" method="POST">
        @csrf
        <div class="title">{{ __('profile.change_password') }}</div>
        <div class="form-group row">
            <label for="oldPassword" class="label">{{ __('profile.password_old') }} <span class="required">*</span></label>
            <input type="password" name="old_password" id="oldPassword">
            @error('old_password')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group row">
            <label for="password" class="label">{{ __('message.password') }} <span class="required">*</span></label>
            <input type="password" name="password" id="password">
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group row">
            <label for="confirm_password" class="label">{{ __('message.password_confirm') }}</label>
            <input type="password" name="password_confirmation" id="confirm-password">
            @error('confirm_password')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-button row">
            <button>{{ __('profile.change_password') }}</button>
        </div>
        <div class="form-rq-link row">
            <a href="{{ route('home') }}">Home</a>
        </div>  
    </form>
@endsection
