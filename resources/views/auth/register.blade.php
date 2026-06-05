@extends('layouts.auth')

@section('title', 'Crear Cuenta')

@section('content')
    <div class="auth-box">
        <img src="{{ asset('img/pato.png') }}" alt="Avatar">

        @if ($errors->any())
            <div class="error-msg">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form action="{{ route('registro.post') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" name="first_name" placeholder="Nombres" required autocomplete="off">
            </div>
            <div class="input-group">
                <input type="text" name="last_name" placeholder="Apellidos" required autocomplete="off">
            </div>
            <div class="input-group">
                <input type="email" name="email" placeholder="Correo electrónico" required autocomplete="off">
            </div>
            <div class="input-group">
                <input type="text" name="nickname" placeholder="Nickname" required autocomplete="off">
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Contraseña" required minlength="4">
            </div>

            




            <button type="submit" class="btn">Crear cuenta</button>
        </form>
    </div>
@endsection

@section('bottom-link')
    <a href="{{ route('login') }}" class="link-bottom">Ya tengo una cuenta</a>
@endsection
