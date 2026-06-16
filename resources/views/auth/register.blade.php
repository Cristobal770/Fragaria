<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Fragaria</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .register-container {
            background-color: white;
            width: 100%;
            max-width: 500px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            text-align: center;
            margin: 20px;
        }
        .register-container h1 {
            margin: 0 0 5px;
            font-size: 28px;
            color: #111;
            font-weight: 700;
        }
        .register-container p {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }
        .form-row {
            display: flex;
            gap: 15px;
        }
        .form-group {
            text-align: left;
            margin-bottom: 20px;
            flex: 1;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.3s;
            background-color: #fafafa;
        }
        .form-control:focus {
            border-color: #111;
            outline: none;
        }
        .btn-register {
            width: 100%;
            background-color: #111;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }
        .btn-register:hover {
            background-color: #333;
        }
        .login-link {
            margin-top: 25px;
            font-size: 13px;
            color: #666;
        }
        .login-link a {
            color: #111;
            font-weight: bold;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .error-messages {
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 13px;
            text-align: left;
        }
        .error-messages ul {
            margin: 0;
            padding-left: 20px;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h1>Únete a Fragaria</h1>
    <p>Crea tu cuenta y comparte tus reseñas</p>

    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('registro.post') }}" method="POST">
        @csrf
        
        <div class="form-row">
            <div class="form-group">
                <label for="nombres">Nombres</label>
                <input type="text" id="nombres" name="nombres" class="form-control" value="{{ old('nombres') }}" required autofocus>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control" value="{{ old('apellidos') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label for="nickname">Nickname (Público)</label>
            <input type="text" id="nickname" name="nickname" class="form-control" value="{{ old('nickname') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>
        </div>

        <button type="submit" class="btn-register">Crear Cuenta</button>
    </form>

    <div class="login-link">
        ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
    </div>
</div>

</body>
</html>
