<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

@if ($errors->any())
    <div style="color:red;">
        {{ $errors->first() }}
    </div>
@endif

<form action="/login" method="POST">
    @csrf

    <label>Email:</label>
    <input type="email" name="Email" required><br><br>

    <label>Password:</label>
    <input type="password" name="Password" required><br><br>

    <button type="submit">Login</button>
</form>

<br>

<a href="/register/patient">Register as Patient</a><br>
<a href="/register/family">Register as Family Member</a>

</body>
</html>
