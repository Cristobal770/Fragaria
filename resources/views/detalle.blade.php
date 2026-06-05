<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $perfume->nombre }} - Fragaria</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f0f0f0;
            color: #111;
            min-height: 100vh;
            padding: 30px;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            font-size: 13px;
            color: #555;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* ── CARD PRINCIPAL ── */
        .perfume-detail-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            padding: 25px;
            display: flex;
            gap: 30px;
            max-width: 750px;
            margin: 0 auto;
        }

        .perfume-detail-card img {
            width: 180px;
            min-width: 180px;
            height: 220px;
            object-fit: cover;
            border-radius: 8px;
        }

        .perfume-detail-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .perfume-detail-nombre {
            font-size: 26px;
            font-weight: 700;
            color: #111;
        }

        .perfume-detail-sub {
            font-size: 13px;
            color: #888;
        }

        .perfume-detail-desc {
            font-size: 13px;
            color: #555;
            line-height: 1.5;
        }

        .perfume-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 5px;
        }

        .stat-box {
            background-color: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 12px 15px;
        }

        .stat-label {
            font-size: 11px;
            color: #999;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 15px;
            font-weight: 600;
            color: #111;
        }

        .stat-value .estrella {
            color: #f5a623;
        }


            .content-wrapper {
            max-width: 750px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* ── MI RESEÑA ── */
        .mi-resena-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            padding: 20px 25px;
        }

        .mi-resena-card h3 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        /* formulario estrellas */
        .stars-input {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 4px;
            margin-bottom: 12px;
        }

        .stars-input input { display: none; }

        .stars-input label {
            font-size: 28px;
            color: #ddd;
            cursor: pointer;
        }

        .stars-input input:checked ~ label,
        .stars-input label:hover,
        .stars-input label:hover ~ label {
            color: #f5a623;
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            color: #888;
            margin-bottom: 4px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 13px;
            color: #333;
            outline: none;
            background: #fafafa;
        }

        .form-group textarea { resize: vertical; min-height: 80px; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .btn-publicar {
            background-color: #111;
            color: white;
            border: none;
            padding: 9px 20px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 5px;
        }

        .btn-publicar:hover { background-color: #333; }

        /* reseña ya publicada */
        .resena-publicada-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }

        .resena-nickname { font-size: 13px; font-weight: 700; }
        .resena-fecha    { font-size: 12px; color: #888; margin-top: 2px; }
        .resena-estrellas { color: #f5a623; font-size: 15px; }

        .resena-comentario { font-size: 13px; color: #333; margin: 8px 0; }

        .resena-meta {
            font-size: 12px;
            color: #666;
            display: flex;
            gap: 20px;
            margin-bottom: 12px;
        }

        .resena-acciones { display: flex; gap: 8px; }

        .btn-editar {
            background-color: #111;
            color: white;
            border: none;
            padding: 7px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-eliminar {
            background-color: #e53935;
            color: white;
            border: none;
            padding: 7px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
        }

        /* ── RESEÑAS OTROS ── */
        .resenas-titulo {
            font-size: 18px;
            font-weight: 700;
            color: #111;
        }

        .resena-card {
            background: white;
            border-radius: 10px;
            border: 1px solid #e0e0e0;
            padding: 18px 22px;
        }
    </style>
</head>
<body>
    <a href="{{ route('fra.inicio') }}" class="back-link">← Volver al catálogo</a>

    <div class="content-wrapper">

        {{-- CARD PERFUME --}}
        <div class="perfume-detail-card">
            @if($perfume->imagen)
                <img src="{{ asset('img/' . $perfume->imagen) }}" alt="{{ $perfume->nombre }}">
            @else
                <div style="width:180px;min-width:180px;height:220px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#aaa;font-size:12px;">Sin imagen</div>
            @endif

            <div class="perfume-detail-info">
                <div class="perfume-detail-nombre">{{ $perfume->marca->nombre }} {{ $perfume->nombre }}</div>
                <div class="perfume-detail-sub">{{ $perfume->marca->nombre }} • {{ $perfume->categoria->nombre }}</div>
                <div class="perfume-detail-desc">{{ $perfume->descripcion }}</div>
                <div class="perfume-stats">
                    <div class="stat-box">
                        <div class="stat-label">Duración promedio</div>
                        <div class="stat-value">{{ $perfume->duracion_promedio > 0 ? $perfume->duracion_promedio . ' horas' : 'Sin datos' }}</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-label">Proyección</div>
                        <div class="stat-value">{{ ucfirst($perfume->proyeccion_promedio) }}</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-label">Calificación</div>
                        <div class="stat-value">
                            {{ $perfume->calificacion_promedio > 0 ? number_format($perfume->calificacion_promedio, 1) . ' / 5' : 'Sin datos' }}
                            @if($perfume->calificacion_promedio > 0)<span class="estrella">★</span>@endif
                        </div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-label">Total reseñas</div>
                        <div class="stat-value">{{ $perfume->total_resenas }} reseñas</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MI RESEÑA --}}
        <div class="mi-resena-card">
            <h3>Tu reseña</h3>

                @if($miResena)
        @if(request('editar') == 1)
            <form action="{{ route('resena.actualizar', $miResena->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Calificación</label>
                    <div class="stars-input">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" name="calificacion" id="star{{ $i }}" value="{{ $i }}"
                                {{ $miResena->calificacion == $i ? 'checked' : '' }} required>
                            <label for="star{{ $i }}">★</label>
                        @endfor
                    </div>
                </div>
                <div class="form-group">
                    <label>Comentario</label>
                    <textarea name="comentario" required>{{ $miResena->comentario }}</textarea>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Duración (horas)</label>
                        <input type="number" name="duracion" min="1" max="48" value="{{ $miResena->duracion }}" required>
                    </div>
                    <div class="form-group">
                        <label>Proyección</label>
                        <select name="proyeccion" required>
                            <option value="leve"     {{ $miResena->proyeccion == 'leve'     ? 'selected' : '' }}>Leve</option>
                            <option value="moderado" {{ $miResena->proyeccion == 'moderado' ? 'selected' : '' }}>Moderado</option>
                            <option value="intenso"  {{ $miResena->proyeccion == 'intenso'  ? 'selected' : '' }}>Intenso</option>
                        </select>
                    </div>
                </div>
                <div style="display:flex; gap:8px; margin-top:5px;">
                    <button type="submit" class="btn-publicar">Actualizar reseña</button>
                    <a href="{{ route('perfume.detalle', $perfume->id) }}" class="btn-editar" style="text-decoration:none; padding: 9px 20px;">Cancelar</a>
                </div>
            </form>
        @else
            <div class="resena-publicada-header">
                <div>
                    <div class="resena-nickname">@ {{ Auth::user()->nickname }}</div>
                    <div class="resena-fecha">{{ \Carbon\Carbon::parse($miResena->fecha_publicacion)->translatedFormat('d F Y') }}</div>
                </div>
                <div class="resena-estrellas">
                    @for($i = 1; $i <= 5; $i++){{ $i <= $miResena->calificacion ? '★' : '☆' }}@endfor
                </div>
            </div>
            <div class="resena-comentario">{{ $miResena->comentario }}</div>
            <div class="resena-meta">
                <span>Duración: {{ $miResena->duracion }} horas</span>
                <span>Proyección: {{ ucfirst($miResena->proyeccion) }}</span>
            </div>
            <div class="resena-acciones">
                <a href="{{ route('perfume.detalle', $perfume->id) }}?editar=1" class="btn-editar" style="text-decoration:none; padding: 7px 14px;">Editar reseña</a>
                <form action="{{ route('resena.eliminar', $miResena->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-eliminar">Eliminar reseña</button>
                </form>
            </div>
        @endif
            @else
                {{-- FORMULARIO NUEVA RESEÑA --}}
                @if($errors->any())
                    <div style="background:#fff0f0;color:#cc0000;border:1px solid #ffcccc;padding:10px;border-radius:6px;margin-bottom:15px;font-size:13px;">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('resena.guardar', $perfume->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Calificación</label>
                        <div class="stars-input">
                            @for($i = 5; $i >= 1; $i--)
                                <input type="radio" name="calificacion" id="star{{ $i }}" value="{{ $i }}" {{ old('calificacion') == $i ? 'checked' : '' }} required>
                                <label for="star{{ $i }}">★</label>
                            @endfor
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Comentario</label>
                        <textarea name="comentario" placeholder="Escribe tu opinión sobre este perfume..." required>{{ old('comentario') }}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Duración (horas)</label>
                            <input type="number" name="duracion" min="1" max="48" placeholder="ej: 8" value="{{ old('duracion') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Proyección</label>
                            <select name="proyeccion" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="leve"     {{ old('proyeccion') == 'leve'     ? 'selected' : '' }}>Leve</option>
                                <option value="moderado" {{ old('proyeccion') == 'moderado' ? 'selected' : '' }}>Moderado</option>
                                <option value="intenso"  {{ old('proyeccion') == 'intenso'  ? 'selected' : '' }}>Intenso</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn-publicar">Publicar reseña</button>
                </form>
            @endif
        </div>

        {{-- RESEÑAS DE OTROS USUARIOS --}}
        @if($resenas->count() > 0)
            <div class="resenas-titulo">Reseñas de usuarios</div>
            @foreach($resenas as $resena)
                <div class="resena-card">
                    <div class="resena-publicada-header">
                        <div>
                            <div class="resena-nickname">@ {{ $resena->user->nickname }}</div>
                            <div class="resena-fecha">{{ \Carbon\Carbon::parse($resena->fecha_publicacion)->translatedFormat('d F Y') }}</div>
                        </div>
                        <div class="resena-estrellas">
                            @for($i = 1; $i <= 5; $i++){{ $i <= $resena->calificacion ? '★' : '☆' }}@endfor
                        </div>
                    </div>
                    <div class="resena-comentario">{{ $resena->comentario }}</div>
                    <div class="resena-meta">
                        <span>Duración: {{ $resena->duracion }} horas</span>
                        <span>Proyección: {{ ucfirst($resena->proyeccion) }}</span>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</body>
</html>