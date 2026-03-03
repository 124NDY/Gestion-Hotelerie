<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — GestionHotelerie</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a6b7c, #2d9cad, #1a4a5c);
            font-family: 'Segoe UI', sans-serif;
        }

        .login-container {
            width: 350px;
        }

        h2 {
            text-align: center;
            color: white;
            letter-spacing: 4px;
            font-size: 18px;
            font-weight: 300;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .login-box {
            background: rgba(30, 40, 50, 0.85);
            padding: 30px;
            border-radius: 4px;
        }

        .input-group {
            display: flex;
            align-items: center;
            background: #d0d0d0;
            border-radius: 3px;
            margin-bottom: 15px;
            padding: 10px 15px;
        }

        .input-group i {
            color: #666;
            margin-right: 10px;
            font-size: 16px;
        }

        .input-group input {
            background: transparent;
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
            color: #333;
        }

        .input-group input::placeholder {
            color: #888;
        }

        .remember-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            color: #aaa;
            font-size: 13px;
        }

        .remember-row label {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        .remember-row input[type="checkbox"] {
            accent-color: #2d9cad;
        }

        .remember-row a {
            color: #aaa;
            text-decoration: none;
            font-size: 12px;
        }

        .remember-row a:hover {
            color: white;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #2d9cad;
            color: white;
            border: none;
            border-radius: 3px;
            font-size: 14px;
            letter-spacing: 3px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background: #1a7a8a;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.3);
            color: #ff6b6b;
            padding: 10px;
            border-radius: 3px;
            margin-bottom: 15px;
            font-size: 13px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>User Login</h2>

    <div class="login-box">

        @if($errors->any())
            <div class="alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="email" name="email"
                       placeholder="Email ID"
                       value="{{ old('email') }}" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password"
                       placeholder="Password" required>
            </div>

            <div class="remember-row">
                <label>
                    <input type="checkbox" name="remember">
                    Remember me
                </label>
                <a href="#">Forgot Password?</a>
            </div>

            <button type="submit" class="btn-login">Login</button>

        </form>
    </div>
</div>

</body>
</html>