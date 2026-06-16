<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Perfume;
use App\Models\Resena;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $user = User::create([
            'nombres' => 'Juan',
            'apellidos' => 'Pérez',
            'nickname' => 'juanpe_retro',
            'email' => 'juan@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        $marcas = [
            'Carolina Herrera' => Marca::create(['nombre' => 'Carolina Herrera']),
            'Dior' => Marca::create(['nombre' => 'Dior']),
            'Chanel' => Marca::create(['nombre' => 'Chanel']),
            'Versace' => Marca::create(['nombre' => 'Versace']),
            'Yves Saint Laurent' => Marca::create(['nombre' => 'Yves Saint Laurent']),
        ];

  
        $categorias = [
            'Amaderado' => Categoria::create(['nombre' => 'Amaderado']),
            'Oriental' => Categoria::create(['nombre' => 'Oriental']),
            'Cítrico' => Categoria::create(['nombre' => 'Cítrico']),
            'Dulce' => Categoria::create(['nombre' => 'Dulce']),
            'Fresco' => Categoria::create(['nombre' => 'Fresco']),
        ];

   
        $perfumes = [
            Perfume::create([
                'nombre' => '212 VIP',
                'descripcion' => 'Una fragancia nocturna y exclusiva.',
                'marca_id' => $marcas['Carolina Herrera']->id,
                'categoria_id' => $categorias['Dulce']->id,
                'imagen' => 'img/212vip.webp'
            ]),
            Perfume::create([
                'nombre' => 'Bad Boy',
                'descripcion' => 'Un viaje complejo para los sentidos.',
                'marca_id' => $marcas['Carolina Herrera']->id,
                'categoria_id' => $categorias['Oriental']->id,
                'imagen' => 'img/badboy.webp'
            ]),
            Perfume::create([
                'nombre' => 'Sauvage',
                'descripcion' => 'Radicalmente fresco, crudo y noble.',
                'marca_id' => $marcas['Dior']->id,
                'categoria_id' => $categorias['Fresco']->id,
                'imagen' => 'img/sauvage.webp'
            ]),
            Perfume::create([
                'nombre' => 'Bleu de Chanel',
                'descripcion' => 'Elegancia atemporal y frescura aromática.',
                'marca_id' => $marcas['Chanel']->id,
                'categoria_id' => $categorias['Amaderado']->id,
                'imagen' => 'img/bleudechanel.webp'
            ]),
            Perfume::create([
                'nombre' => 'Eros',
                'descripcion' => 'Amor, pasión, belleza y deseo.',
                'marca_id' => $marcas['Versace']->id,
                'categoria_id' => $categorias['Oriental']->id,
                'imagen' => 'img/eros.webp'
            ]),
            Perfume::create([
                'nombre' => 'Good Girl',
                'descripcion' => 'Audaz, sofisticada y empoderadora.',
                'marca_id' => $marcas['Carolina Herrera']->id,
                'categoria_id' => $categorias['Dulce']->id,
                'imagen' => 'img/goodgirl.avif'
            ]),
            Perfume::create([
                'nombre' => 'Libre',
                'descripcion' => 'La fragancia de la libertad.',
                'marca_id' => $marcas['Yves Saint Laurent']->id,
                'categoria_id' => $categorias['Oriental']->id,
                'imagen' => 'img/libre.jpg'
            ]),
        ];

        foreach ($perfumes as $perfume) {
            Resena::create([
                'user_id' => $user->id,
                'perfume_id' => $perfume->id,
                'calificacion' => rand(3, 5),
                'comentario' => '¡Me encanta esta fragancia! Muy recomendada.',
                'duracion' => rand(4, 12),
                'proyeccion' => ['leve', 'moderado', 'intenso'][rand(0, 2)],
            ]);
        }
    }
}