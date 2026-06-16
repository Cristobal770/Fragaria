@extends('layouts.menu')

@section('page-title', 'Catálogo de perfumes')

@section('content')
<style>
    .grid-perfumes {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .perfume-card {
        background: white;
        border-radius: 10px;
        border: 1px solid #e5e5e5;
        display: flex;
        overflow: hidden;
    }

    .perfume-card img {
        width: 140px;
        min-width: 140px;
        height: 160px;
        object-fit: cover;
        display: block;
        flex-shrink: 0;
    }

    .perfume-card .placeholder-img {
        width: 140px;
        min-width: 140px;
        height: 160px;
        background-color: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #aaa;
        font-size: 12px;
    }

    .perfume-info {
        padding: 14px 16px;
        display: flex;
        flex-direction: column;
        gap: 5px;
        flex-grow: 1;
    }

    .perfume-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .perfume-marca {
        font-size: 11px;
        color: #888;
    }

    .perfume-nombre {
        font-size: 18px;
        font-weight: 700;
        color: #111;
        margin-top: 1px;
    }

    .perfume-badge {
        display: inline-block;
        background-color: #f0f0f0;
        color: #444;
        font-size: 11px;
        padding: 3px 8px;
        border-radius: 20px;
    }

    .perfume-desc {
        font-size: 12px;
        color: #666;
        margin-top: 2px;
    }

    .perfume-datos {
        font-size: 12px;
        color: #444;
        margin-top: 4px;
    }

    .perfume-datos span {
        font-weight: 600;
    }

    .proyeccion-leve      { color: #2196F3; }
    .proyeccion-moderado  { color: #FF9800; }
    .proyeccion-intenso   { color: #F44336; }

    .perfume-footer {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 6px;
    }

    .estrellas {
        color: #f5a623;
        font-size: 13px;
    }

    .reviews {
        font-size: 12px;
        color: #888;
    }

    .btn-detalle {
        margin-left: auto;
        font-size: 12px;
        color: #1a73e8;
        text-decoration: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
    }

    .btn-detalle:hover {
        text-decoration: underline;
    }
</style>

<div class="grid-perfumes">
    @foreach($perfumes as $perfume)
    <div class="perfume-card">

        @if($perfume->imagen)
            <img src="{{ asset($perfume->imagen) }}" alt="{{ $perfume->nombre }}">
        @else
            <div class="placeholder-img">Sin imagen</div>
        @endif

        <div class="perfume-info">
            <div class="perfume-top">
                <div>
                    <div class="perfume-marca">{{ $perfume->marca->nombre }}</div>
                    <div class="perfume-nombre">{{ $perfume->nombre }}</div>
                </div>
                <a href="{{ route('perfume.detalle', $perfume->id) }}" class="btn-detalle">Ver detalle</a>
            </div>

            <span class="perfume-badge">{{ $perfume->categoria->nombre }}</span>

            <div class="perfume-desc">{{ $perfume->descripcion }}</div>

            <div class="perfume-datos">
                Duración: <span>{{ $perfume->duracion_promedio > 0 ? $perfume->duracion_promedio . ' horas' : 'Sin datos' }}</span>
            </div>
            <div class="perfume-datos">
                Proyección: <span class="proyeccion-{{ strtolower($perfume->proyeccion) }}">
                    {{ $perfume->proyeccion }}
                </span>
            </div>

            <div class="perfume-footer">
                <span class="estrellas">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= round($perfume->calificacion_promedio) ? '★' : '☆' }}
                    @endfor
                </span>
                <span class="reviews">({{ $perfume->total_resenas }} reviews)</span>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection