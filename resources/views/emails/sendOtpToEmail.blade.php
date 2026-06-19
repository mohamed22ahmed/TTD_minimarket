<!DOCTYPE html>
<html>
<head>
    <title>New Login Detected</title>
</head>
<body>
<h1>Hello {{ $user->name }}!</h1>

<p>We detected a new login to your account.</p>
<p>Your OTP is: </p><p style="font-size: large">{{ $user->otp }}</p>

<p>If this wasn't you, please secure your account immediately.</p>

<p>Thanks,<br>{{ config('app.name') }}</p>
</body>
</html>
