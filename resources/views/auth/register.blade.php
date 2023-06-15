@extends('layout.index')
@section('content')
<form class="form" method="POST">
    @csrf
    <div class="title">Sign up</div>
    <div class="form-group row">
        <label for="name" class="label">Username<span class="required">*</span></label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
    </div>
    <div class="form-group row">
        <label for="email" class="label">Email <span class="required">*</span></label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
    </div>
    <div class="form-group row">
        <label for="password" class="label">Password <span class="required">*</span></label>
        <input type="password" name="password" id="password">
    </div>
    <div class="form-group row">
        <label for="confirm_password" class="label">Password confirm <span class="required">*</span></label>
        <input type="password" name="confirm_password" id="confirm_password">
        @error('name')
            <span class="error">{{ $message  }}</span>
        @enderror
        @error('email')
        <span class="error">{{ $message  }}</span>
        @enderror
        @error('password')
        <span class="error">{{ $message  }}</span>
        @enderror
        @error('confirm_password')
        <span class="error">{{ $message  }}</span>
        @enderror
    </div>
    <div class="form-button row">
        <button>Sign up</button>
    </div>
    <div class="form-rq-link row">
        <a href="{{ route('login') }}">Already have an account? Login</a>
    </div>
</form>
@endsection
