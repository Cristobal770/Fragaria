@extends('layouts.auth')

@section('title', 'Iniciar Sesión')

@section('content')
    <style>
        .user-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .user-item {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            color: white;
            padding: 5px;
            border-radius: 5px;
            transition: background 0.2s;
            cursor: pointer;
            border: 1px solid transparent;
        }

        .user-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .user-item img {
            width: 55px;
            height: 55px;
            border-radius: 4px;
            border: 2px solid #fff;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 18px;
            font-weight: 500;
        }

        .login-form-selected {
            margin-top: 10px;
            display: flex;
            gap: 5px;
        }

        .login-form-selected input {
            padding: 5px;
            border-radius: 2px;
            border: none;
            width: 150px;
        }

        .login-form-selected button {
            background-color: #319A31;
            border: 1px solid white;
            color: white;
            cursor: pointer;
            padding: 0 10px;
            border-radius: 2px;
        }
    </style>

    <div class="user-list">
        @forelse($usuarios as $user)
            @if ($usuarioSeleccionado && $usuarioSeleccionado->id == $user->id)
                <div class="user-item"
                    style="background-color: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3);">
                    <img src="{{ asset('img/' . $user->avatar) }}" alt="Avatar">
                    <div class="user-info">
                        <span class="user-name">{{ $user->first_name }} {{ $user->last_name }}</span>
                        <form action="{{ route('login.post') }}" method="POST" class="login-form-selected">
                            @csrf
                            <input type="text" name="nickname" placeholder="Nickname" required>
                            <input type="password" name="password" placeholder="Contraseña" autofocus required>
                            <button type="submit">➔</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login', ['user_id' => $user->id]) }}" class="user-item">
                    <img src="{{ asset('img/' . $user->avatar) }}" alt="Avatar">
                    <div class="user-info">
                        <span class="user-name">{{ $user->first_name }} {{ $user->last_name }}</span>
                        <span style="font-size: 12px; color: #ccc;">Haz clic para iniciar sesión</span>
                    </div>
                </a>
            @endif
        @empty
            <p style="text-align: center; opacity: 0.7;">No hay usuarios creados.<br>Usa el enlace de abajo para
                registrarte.</p>
        @endforelse

        @if ($errors->any())
            <div class="error-msg" style="margin-top: 10px;">
                {{ $errors->first() }}
            </div>
        @endif
    </div>
@endsection

@section('bottom-link')
    <a href="{{ route('registro') }}" class="link-bottom">Crear una cuenta en este equipo</a>
@endsection
