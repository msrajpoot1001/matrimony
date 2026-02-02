<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        .card {
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .btn-login {
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1 class="text-danger">🚫 Unauthorized Access</h1>
        <p>You do not have permission to access this page.</p>

        @guest
            <a href="{{ route('login') }}" class="btn btn-primary btn-login">Login</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-secondary btn-login">Go Back</a>
        @endguest
    </div>
</body>

</html>
