<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfume extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['duracion_promedio', 'calificacion_promedio', 'total_resenas'];

    public function marca() {
        return $this->belongsTo(Marca::class);
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function resenas() {
        return $this->hasMany(Resena::class);
    }

    
    public function getCalificacionPromedioAttribute() {
        return round($this->resenas()->avg('calificacion') ?? 0, 1);
    }

    public function getDuracionPromedioAttribute() {
        return round($this->resenas()->avg('duracion') ?? 0, 1);
    }

    public function getTotalResenasAttribute() {
        return $this->resenas()->count();
    }

    public function getProyeccionAttribute() {
        $proyecciones = $this->resenas()->pluck('proyeccion');
        
        if ($proyecciones->isEmpty()) {
            return 'Sin datos';
        }
        
        
        $conteos = array_count_values($proyecciones->toArray());
        arsort($conteos);
        
        
        return ucfirst(array_key_first($conteos));
    }
}