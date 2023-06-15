@extends('layout.index')
@section('content')
<form class="form" method="POST">
    @csrf
    <div class="title">Forgot password</div>
    <div class="form-group row">
        <label for="email" class="label">Email <span class="required">*</span></label>
        <input type="email" name="email" id="email" autocomplete="false" >
    </div>
    <div class="form-button row">
        <button>Send</button>
    </div>
</form>
@endsection
