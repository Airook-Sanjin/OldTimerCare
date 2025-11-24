<!DOCTYPE html>
<html>
<head>
    <title>Register Patient</title>
</head>
<body>

<h2>Patient Registration</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/register/patient" method="POST">
    @csrf

    <label>First Name:</label>
    <input type="text" name="FirstName" required><br><br>

    <label>Last Name:</label>
    <input type="text" name="LastName" required><br><br>

    <label>Email:</label>
    <input type="email" name="Email" required><br><br>

    <label>Password:</label>
    <input type="password" name="Password" required><br><br>

    <label>Phone:</label>
    <input type="text" name="Phone"><br><br>

    <label>Address:</label>
    <input type="text" name="Address"><br><br>

    <label>Date of Birth:</label>
    <input type="date" name="DateOfBirth"><br><br>

    <button type="submit">Register</button>
</form>

<br>
<a href="/login">Back to Login</a>

</body>
</html>
