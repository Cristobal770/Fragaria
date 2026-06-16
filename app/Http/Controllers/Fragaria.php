<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfume;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Resena;
use Illuminate\Support\Facades\Auth;

class Fragaria extends Controller
{
    public function inicio(Request $request)
    {
        $query = Perfume::with(['marca', 'categoria', 'resenas']);

        
        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        
        if ($request->filled('marca_id')) {
            $query->where('marca_id', $request->marca_id);
        }

        
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        $perfumes = $query->get();
        $marcas = Marca::all();
        $categorias = Categoria::all();

        return view('inicio', compact('perfumes', 'marcas', 'categorias'));
    }

    
    public function detalle($id)
    {
        
        $perfume = Perfume::with(['marca', 'categoria', 'resenas.user'])->findOrFail($id);
        
        $userResena = null;
        if (Auth::check()) {
            $userResena = $perfume->resenas()->where('user_id', Auth::id())->first();
        }

        return view('detalle', compact('perfume', 'userResena'));
    }

    
    public function guardarResena(Request $request, $id)
    {
        $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string',
            'duracion' => 'required|numeric|min:1',
            'proyeccion' => 'required|in:leve,moderado,intenso',
        ]);

        Resena::create([
            'user_id' => Auth::id(),
            'perfume_id' => $id,
            'calificacion' => $request->calificacion,
            'comentario' => $request->comentario,
            'duracion' => $request->duracion,
            'proyeccion' => $request->proyeccion,
        ]);

        return back()->with('success', 'Reseña publicada correctamente.');
    }

    
    public function actualizarResena(Request $request, $id)
    {
        $request->validate([
            'calificacion' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string',
            'duracion' => 'required|numeric|min:1',
            'proyeccion' => 'required|in:leve,moderado,intenso',
        ]);

        $resena = Resena::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        $resena->update([
            'calificacion' => $request->calificacion,
            'comentario' => $request->comentario,
            'duracion' => $request->duracion,
            'proyeccion' => $request->proyeccion,
        ]);

        return back()->with('success', 'Reseña actualizada correctamente.');
    }

    
    public function eliminarResena($id)
    {
        $resena = Resena::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $resena->delete();

        return back()->with('success', 'Reseña eliminada.');
    }
}
