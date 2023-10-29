<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <style>
    .btn-register-admin {
        width: 100%;
        padding: 10px;
        margin-top: 20px;
        background-color: #00884b;
        color: #fff;
        font-weight: bold;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        background: #00884b;
    }
    </style>
</head>

<body>
    <div class="signup">
        <div class="signup-classic">
            <form action="/register-admin" method="POST">
                @csrf
                <h2>Admin Register</h2>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" class="btn-register-admin">Register</button>
            </form>
        </div>
    </div>
</body>

</html>