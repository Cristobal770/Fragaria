<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Perfume;
use Illuminate\Http\Request;

class PerfumeController extends Controller
{
    public function index(Request $request)
    {

        $query = Perfume::with(['marca', 'categoria', 'resenas']);

        if ($request->has('search') && $request->search != '') {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        $perfumes = $query->get()->map(function ($perfume) {

            $ultimaResena = $perfume->resenas()->latest()->first();
            $proyeccion = $ultimaResena ? $ultimaResena->proyeccion : 'Sin datos';

            return [
                'nombre' => $perfume->nombre,
                'descripcion' => $perfume->descripcion,
                'marca' => $perfume->marca->nombre ?? 'Sin marca',
                'familia_olfativa' => $perfume->categoria->nombre ?? 'Sin categoría',
                'duracion' => $perfume->duracion_promedio, // Viene del cálculo en el Modelo
                'proyeccion' => $proyeccion,
            ];
        });

        return response()->json($perfumes);
    }
}