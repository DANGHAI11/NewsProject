@extends('layout.index')
@section('content')
<form class="form" action="{{ route('post-login') }}" method="POST">
    @csrf
    <div class="title">Sign in</div>
    <div class="form-group row">
        <label for="email" class="label">Username or email <span class="required">*</span></label>
        <input type="email" name="email" id="email" autocomplete="false" value="{{ old('email') }}">
    </div>
    <div class="form-group row">
        <label for="password" class="label">Password <span class="required">*</span></label>
        <input type="password" name="password" id="password" autocomplete="false">
        @error('email')
        <span class="error">{{ $message  }}</span>
        @enderror
        @error('password')
        <span class="error">{{ $message  }}</span>
        @enderror
    </div>
    <div class="form-space-between">
        <div class="remember row">
            <input type="checkbox" name="remember" id="remember_id"><label for="remember_id">Remember password</label>
        </div>
        <a href="{{ route('forgot-password') }}">Forgot your password?</a>
    </div>
    <div class="form-button row">
        <button>Login</button>
    </div>
    <div class="form-rq-link row">
        <a href="{{ route('register') }}">Don’t have an account? Sign up here</a>
    </div>
</form>
@endsection
