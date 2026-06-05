<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\perfume;

class Fragaria extends Controller
{
    public function inicio()
    {
        $perfumes = perfume::with(['marca', 'categoria'])->get();
        return view('inicio', compact('perfumes'));
    }

}
