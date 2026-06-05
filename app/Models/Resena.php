<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
    protected $table = 'resenas';

    protected $fillable = [
        'perfume_id',
        'user_id',
        'calificacion',
        'comentario',
        'duracion',
        'proyeccion',
        'fecha_publicacion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}