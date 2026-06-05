<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfume extends Model
{
    protected $table = 'perfumes';

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}