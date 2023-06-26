@extends('layout.index')
@section('content')
    <form class="form" method="POST">
        @csrf
        <input type="hidden" name="status" value="1">
        <div class="title">{{ __('message.forgot_password') }}</div>
        <div class="form-group row">
            <label for="email" class="label">{{ __('message.email') }} <span class="required">*</span></label>
            <input type="email" name="email" id="email" autocomplete="false">
        </div>
        <div class="form-button row">
            <button>{{ __('message.send') }}</button>
        </div>
    </form>
@endsection
