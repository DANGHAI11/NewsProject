<h1>Email Verification Mail</h1>
<p>Hello {{ $name }} this is the system auto mail</p>
<div>Please verify your email with bellow link:
<a href="{{ route('verify-email', $token) }}">Verify Email</a>
</div>
