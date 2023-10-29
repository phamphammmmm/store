<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
    .btn-login-admin {
        margin: 0 auto;
        width: 35%;
        border: none;
        border-radius: 5px;
        padding: 10px;
        background: #00884b;
        color: #fff;
    }
    </style>
</head>

<body>
    <div class="login-form">
        <form action="/login-admin" method="POST">
            @csrf
            <h2>Admin Login</h2>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="btn-login-admin">Login</button>
        </form>
        <p class="text-center">
            Don't you have an account?<a href="{{ route('register-admin') }}"> Sign up</a>
        </p>
    </div>
</body>

</html>