<h1>Change the password Mail</h1>
<p>Hello {{ $name }} this is the system auto mail</p>
<div>Please click with bellow link::
    <a href="{{ route('change-password', $token) }}">Change password</a>
</div>
