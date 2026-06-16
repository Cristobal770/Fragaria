@extends('layouts.menu')

@section('page-title', $perfume->nombre)

@section('content')
<style>
    .detalle-container {
        padding: 20px;
        max-width: 1100px;
        margin: 0 auto;
        color: #333;
    }

    .perfume-header {
        display: flex;
        background: white;
        border-radius: 12px;
        border: 1px solid #e5e5e5;
        padding: 25px;
        gap: 30px;
        margin-bottom: 30px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }

    .perfume-header img {
        width: 280px;
        height: 320px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #eee;
    }

    .placeholder-img-large {
        width: 280px;
        height: 320px;
        background-color: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #aaa;
        border-radius: 8px;
    }

    .perfume-info-full {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .perfume-info-full h1 {
        font-size: 32px;
        margin: 0 0 5px 0;
        color: #111;
    }

    .perfume-subtitle {
        font-size: 15px;
        color: #666;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .perfume-subtitle strong {
        color: #111;
    }

    .perfume-description {
        font-size: 16px;
        line-height: 1.6;
        color: #444;
        margin-bottom: 25px;
        flex-grow: 1;
    }

    .stats-container {
        display: flex;
        gap: 15px;
    }

    .stat-box {
        background: #fafafa;
        border: 1px solid #eee;
        padding: 15px 20px;
        border-radius: 8px;
        text-align: center;
        flex: 1;
    }

    .stat-value {
        display: block;
        font-size: 20px;
        font-weight: bold;
        color: #111;
        margin-bottom: 4px;
    }

    .stat-value.estrellas {
        color: #f5a623;
    }

    .stat-label {
        font-size: 12px;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .reviews-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .review-panel {
        background: white;
        border-radius: 12px;
        border: 1px solid #e5e5e5;
        padding: 25px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.02);
    }

    .panel-title {
        font-size: 20px;
        margin-top: 0;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #111;
        display: inline-block;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 6px;
        color: #111;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #111;
        outline: none;
    }

    .btn-submit {
        background: #111;
        color: white;
        border: none;
        padding: 12px;
        width: 100%;
        border-radius: 6px;
        font-size: 15px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 10px;
        transition: background 0.3s;
    }

    .btn-submit:hover {
        background: #333;
    }

    .btn-delete {
        background: none;
        border: none;
        color: #d93025;
        font-size: 13px;
        text-decoration: underline;
        width: 100%;
        text-align: center;
        margin-top: 15px;
        cursor: pointer;
    }

    .alert-login {
        background: #fff8e1;
        border: 1px solid #ffecb3;
        color: #856404;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        font-size: 14px;
    }

    .alert-login a {
        color: #856404;
        font-weight: bold;
    }

    .community-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .review-card {
        background: #fafafa;
        border: 1px solid #eee;
        padding: 15px;
        border-radius: 8px;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }

    .review-user {
        font-weight: bold;
        font-size: 14px;
        color: #111;
    }

    .review-date {
        font-size: 12px;
        color: #888;
    }

    .review-meta {
        font-size: 13px;
        color: #666;
        margin-bottom: 8px;
    }

    .review-meta .estrellas {
        color: #f5a623;
        margin-right: 8px;
    }

    .review-text {
        font-size: 14px;
        color: #444;
        font-style: italic;
        margin: 0;
        line-height: 1.5;
    }

    @media (max-width: 768px) {
        .perfume-header { flex-direction: column; }
        .perfume-header img { width: 100%; height: auto; }
        .reviews-layout { grid-template-columns: 1fr; }
        .stats-container { flex-direction: column; }
    }
</style>

<div class="detalle-container">
    
    <a href="{{ route('fra.inicio') }}" style="color: #666; text-decoration: none; font-size: 14px; margin-bottom: 15px; display: inline-block;">
        ← Volver al catálogo
    </a>

    <div class="perfume-header">
        @if($perfume->imagen)
            <img src="{{ asset($perfume->imagen) }}" alt="{{ $perfume->nombre }}">
        @else
            <div class="placeholder-img-large">Sin imagen</div>
        @endif

        <div class="perfume-info-full">
            <h1>{{ $perfume->nombre }}</h1>
            <div class="perfume-subtitle">
                <strong>{{ $perfume->marca->nombre }}</strong> | Familia Olfativa: {{ $perfume->categoria->nombre }}
            </div>
            
            <div class="perfume-description">
                {{ $perfume->descripcion }}
            </div>

            <div class="stats-container">
                <div class="stat-box">
                    <span class="stat-value estrellas">
                        @for($i = 1; $i <= 5; $i++)
                            {{ $i <= round($perfume->calificacion_promedio) ? '★' : '☆' }}
                        @endfor
                        ({{ $perfume->calificacion_promedio }})
                    </span>
                    <span class="stat-label">Basado en {{ $perfume->total_resenas }} reseñas</span>
                </div>
                <div class="stat-box">
                    <span class="stat-value">{{ $perfume->duracion_promedio > 0 ? $perfume->duracion_promedio . ' Hrs' : '--' }}</span>
                    <span class="stat-label">Duración Promedio</span>
                </div>
                <div class="stat-box">
                    <span class="stat-value">{{ ucfirst($perfume->proyeccion) }}</span>
                    <span class="stat-label">Proyección</span>
                </div>
            </div>
        </div>
    </div>

    <div class="reviews-layout">

        <div class="review-panel">
            <h2 class="panel-title">{{ $userResena ? 'Edita tu reseña' : 'Deja tu reseña' }}</h2>
            
            @auth
                <form action="{{ $userResena ? route('resena.actualizar', $userResena->id) : route('resena.guardar', $perfume->id) }}" method="POST">
                    @csrf
                    @if($userResena)
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <label>Calificación (1 a 5 estrellas) *</label>
                        <input type="number" name="calificacion" min="1" max="5" value="{{ old('calificacion', $userResena->calificacion ?? '') }}" class="form-control" placeholder="Ej: 5" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Duración percibida (Horas) *</label>
                        <input type="number" name="duracion" min="1" value="{{ old('duracion', $userResena->duracion ?? '') }}" class="form-control" placeholder="Ej: 8" required>
                    </div>

                    <div class="form-group">
                        <label>Proyección *</label>
                        <select name="proyeccion" class="form-control" required>
                            <option value="">Selecciona una opción...</option>
                            <option value="leve" {{ (old('proyeccion', $userResena->proyeccion ?? '') == 'leve') ? 'selected' : '' }}>Leve</option>
                            <option value="moderado" {{ (old('proyeccion', $userResena->proyeccion ?? '') == 'moderado') ? 'selected' : '' }}>Moderada</option>
                            <option value="intenso" {{ (old('proyeccion', $userResena->proyeccion ?? '') == 'intenso') ? 'selected' : '' }}>Intensa</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Comentario *</label>
                        <textarea name="comentario" rows="4" class="form-control" placeholder="Cuéntanos qué te pareció este perfume..." required>{{ old('comentario', $userResena->comentario ?? '') }}</textarea>
                    </div>

                    <button type="submit" class="btn-submit">
                        {{ $userResena ? 'Actualizar Reseña' : 'Publicar Reseña' }}
                    </button>
                </form>

                @if($userResena)
                    <form action="{{ route('resena.eliminar', $userResena->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('¿Estás seguro de eliminar tu reseña?');">Eliminar mi reseña</button>
                    </form>
                @endif
            @else
                <div class="alert-login">
                    Para poder publicar o editar una reseña, necesitas <br><br>
                    <a href="{{ route('login') }}">Iniciar Sesión</a> o <a href="{{ route('registro') }}">Registrarte</a>
                </div>
            @endauth
        </div>

        <div class="review-panel">
            <h2 class="panel-title">Comunidad ({{ $perfume->total_resenas }})</h2>
            
            <div class="community-list">
                @forelse($perfume->resenas as $resena)
                    <div class="review-card">
                        <div class="review-header">
                            <span class="review-user">👤 {{ $resena->user->nickname }}</span>
                            <span class="review-date">{{ $resena->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="review-meta">
                            <span class="estrellas">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $resena->calificacion ? '★' : '☆' }}
                                @endfor
                            </span>
                            <span>({{ $resena->duracion }} hrs | {{ ucfirst($resena->proyeccion) }})</span>
                        </div>
                        <p class="review-text">"{{ $resena->comentario }}"</p>
                    </div>
                @empty
                    <div class="review-card" style="text-align: center; color: #888;">
                        <p>No hay reseñas aún. Sé el primero en opinar.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection