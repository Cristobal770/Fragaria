<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fragaria</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
            background-color: #f0f0f0;
            color: #111;
        }

        .sidebar {
            width: 200px;
            min-width: 200px;
            background-color: #fff;
            border-right: 1px solid #ddd;
            display: flex;
            flex-direction: column;
            padding: 20px 15px;
            gap: 20px;
        }

        .sidebar-brand {
            font-size: 20px;
            font-weight: 700;
            color: #111;
        }

        .sidebar-brand a {
            text-decoration: none;
            color: inherit;
        }

        .sidebar-user {
            background-color: #f0f0f0;
            border-radius: 8px;
            padding: 10px 12px;
        }

        .sidebar-user .nickname {
            font-size: 13px;
            font-weight: 700;
            color: #111;
        }

        .sidebar-user .fullname {
            font-size: 12px;
            color: #666;
            margin-top: 2px;
        }

        .sidebar-search input {
            width: 100%;
            padding: 7px 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 13px;
            color: #333;
            background: #fafafa;
            outline: none;
        }

        .sidebar-search input:focus {
            border-color: #aaa;
        }

        .sidebar-section-title {
            font-size: 12px;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .sidebar-filters {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sidebar-filters label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            color: #444;
            cursor: pointer;
        }

        .sidebar-filters input[type="radio"] {
            accent-color: #111;
        }

        .sidebar-spacer {
            flex-grow: 1;
        }

        .logout-btn {
            width: 100%;
            background-color: #111;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
        }

        .logout-btn:hover {
            background-color: #333;
        }

        /* ── MAIN ── */
        .main {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .main-header {
            padding: 25px 30px 15px;
            background-color: #f0f0f0;
        }

        .main-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: #111;
        }

        .main-content {
            flex-grow: 1;
            overflow-y: auto;
            padding: 10px 30px 30px;
        }

        /* ── DIVISOR ── */
        .sidebar-divider {
            height: 1px;
            background-color: #e5e5e5;
        }

        .form-filters {
            display: flex;
            flex-direction: column;
            gap: 20px;
            flex-grow: 1;
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-brand">
            <a href="{{ route('fra.inicio') }}">Fragaria</a>
        </div>

        <div class="sidebar-divider"></div>

        @auth
            <div class="sidebar-user">
                <div class="nickname">@ {{ Auth::user()->nickname }}</div>
                <div class="fullname">{{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}</div>
            </div>
        @else
            <div class="sidebar-user">
                <div class="nickname">Modo Invitado</div>
                <div class="fullname"><a href="{{ route('login') }}" style="color: #1a73e8; text-decoration: none;">Iniciar sesión</a></div>
            </div>
        @endauth

        <form action="{{ route('fra.inicio') }}" method="GET" class="form-filters">
            
            <div class="sidebar-search">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar perfume..." onchange="this.form.submit()">
            </div>

            <div class="sidebar-divider"></div>

            <div>
                <div class="sidebar-section-title">Filtrar por marca</div>
                <div class="sidebar-filters">
                    <label>
                        <input type="radio" name="marca_id" value="" {{ request('marca_id') == '' ? 'checked' : '' }} onchange="this.form.submit()"> 
                        Todas
                    </label>
                    @foreach(\App\Models\Marca::all() as $marca)
                        <label>
                            <input type="radio" name="marca_id" value="{{ $marca->id }}" {{ request('marca_id') == $marca->id ? 'checked' : '' }} onchange="this.form.submit()"> 
                            {{ $marca->nombre }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="sidebar-divider"></div>

            <div>
                <div class="sidebar-section-title">Filtrar por categoría</div>
                <div class="sidebar-filters">
                    <label>
                        <input type="radio" name="categoria_id" value="" {{ request('categoria_id') == '' ? 'checked' : '' }} onchange="this.form.submit()"> 
                        Todas
                    </label>
                    @foreach(\App\Models\Categoria::all() as $categoria)
                        <label>
                            <input type="radio" name="categoria_id" value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'checked' : '' }} onchange="this.form.submit()"> 
                            {{ $categoria->nombre }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="sidebar-spacer"></div>
        </form>

        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Cerrar sesión</button>
            </form>
        @endauth
    </aside>

    <main class="main">
        <div class="main-header">
            <h1>@yield('page-title', 'Inicio')</h1>
        </div>
        <div class="main-content">
            @yield('content')
        </div>
    </main>

</body>
</html>