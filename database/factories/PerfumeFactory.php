<?php

namespace Database\Factories;

use App\Models\Perfume;
use App\Models\Marca;  
use App\Models\Categoria; 
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Perfume>
 */
class PerfumeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'marca_id' => Marca::factory(),
            'categoria_id' => Categoria::factory(),
            'nombre' => fake()->word(),
            'descripcion' => fake()->sentence(),
            'imagen' => null,
        ];
    }
}
