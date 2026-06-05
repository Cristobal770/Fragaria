<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fragaria - @yield('title')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .card-title {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #111;
        }

        .card-subtitle {
            font-size: 13px;
            color: #888;
            margin-bottom: 25px;
        }

        .input-group {
            margin-bottom: 12px;
        }

        .input-group input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            outline: none;
            font-size: 14px;
            color: #333;
            background: #fafafa;
        }

        .input-group input:focus {
            border-color: #aaa;
            background: #fff;
        }

        .btn {
            background-color: #111;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
            font-size: 14px;
            margin-top: 5px;
        }

        .btn:hover {
            background-color: #333;
        }

        .link-bottom {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #555;
            text-decoration: none;
            font-size: 13px;
        }

        .link-bottom:hover {
            text-decoration: underline;
        }

        .error-msg {
            background: #fff0f0;
            color: #cc0000;
            border: 1px solid #ffcccc;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 13px;
            text-align: center;
        }

        /* login list styles */
        .user-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .user-item {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #333;
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #eee;
            transition: background 0.2s;
            cursor: pointer;
        }

        .user-item:hover {
            background-color: #f5f5f5;
            border-color: #ddd;
        }

        .user-item img {
            width: 48px;
            height: 48px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 15px;
            font-weight: 600;
            color: #111;
        }

        .user-nick {
            font-size: 12px;
            color: #888;
        }

        .login-form-selected {
            margin-top: 10px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .login-form-selected input {
            padding: 6px 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 13px;
            outline: none;
            width: 200px;
        }

        .login-form-selected button {
            background-color: #111;
            border: none;
            color: white;
            cursor: pointer;
            padding: 6px 14px;
            border-radius: 5px;
            font-size: 13px;
            width: fit-content;
        }

        .login-form-selected button:hover {
            background-color: #333;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-title">@yield('title')</div>
        <div class="card-subtitle">Fragaria</div>

        @yield('content')

        @yield('bottom-link')
    </div>
</body>

</html>