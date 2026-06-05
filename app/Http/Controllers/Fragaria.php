<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\perfume;
use App\Models\Resena;
use Illuminate\Support\Facades\Auth;

class Fragaria extends Controller
{
    public function inicio()
    {
        $perfumes = perfume::with(['marca', 'categoria'])->get();
        return view('inicio', compact('perfumes'));
    }

    public function detalle($id)
    {
        $perfume = perfume::with(['marca', 'categoria'])->findOrFail($id);
        $miResena = Resena::where('perfume_id', $id)->where('user_id', Auth::id())->first();
        $resenas  = Resena::with('user')->where('perfume_id', $id)->where('user_id', '!=', Auth::id())->latest('fecha_publicacion')->get();
        return view('detalle', compact('perfume', 'miResena', 'resenas'));
    }

    public function guardarResena(Request $request, $id)
    {
        $request->validate([
            'calificacion' => 'required|integer|between:1,5',
            'comentario'   => 'required|string',
            'duracion'     => 'required|integer|min:1',
            'proyeccion'   => 'required|in:leve,moderado,intenso',
        ]);

        Resena::create([
            'perfume_id'        => $id,
            'user_id'           => Auth::id(),
            'calificacion'      => $request->calificacion,
            'comentario'        => $request->comentario,
            'duracion'          => $request->duracion,
            'proyeccion'        => $request->proyeccion,
            'fecha_publicacion' => now(),
        ]);

        $this->recalcularPerfume($id);

        return redirect()->route('perfume.detalle', $id);
    }


    private function recalcularPerfume($perfume_id)
    {
        $resenas = Resena::where('perfume_id', $perfume_id)->get();

        if ($resenas->count() === 0) return;

        $duracion_promedio     = round($resenas->avg('duracion'), 1);
        $calificacion_promedio = round($resenas->avg('calificacion'), 2);
        $total_resenas         = $resenas->count();

        $proyeccion_promedio = $resenas->groupBy('proyeccion')
            ->map->count()
            ->sortDesc()
            ->keys()
            ->first();

        perfume::where('id', $perfume_id)->update([
            'duracion_promedio'     => $duracion_promedio,
            'calificacion_promedio' => $calificacion_promedio,
            'proyeccion_promedio'   => $proyeccion_promedio,
            'total_resenas'         => $total_resenas,
        ]);
    }


    public function actualizarResena(Request $request, $id)
    {
        $request->validate([
            'calificacion' => 'required|integer|between:1,5',
            'comentario'   => 'required|string',
            'duracion'     => 'required|integer|min:1',
            'proyeccion'   => 'required|in:leve,moderado,intenso',
        ]);

        $resena = Resena::findOrFail($id);
        $resena->update([
            'calificacion' => $request->calificacion,
            'comentario'   => $request->comentario,
            'duracion'     => $request->duracion,
            'proyeccion'   => $request->proyeccion,
        ]);

        $this->recalcularPerfume($resena->perfume_id);

        return redirect()->route('perfume.detalle', $resena->perfume_id);
    }

    public function eliminarResena($id)
    {
        $resena = Resena::findOrFail($id);
        $perfume_id = $resena->perfume_id;
        $resena->delete();

        $this->recalcularPerfume($perfume_id);

        return redirect()->route('perfume.detalle', $perfume_id);
    }

}
