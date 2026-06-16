<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Perfume;
use Laravel\Sanctum\Sanctum;

class PerfumeApiTest extends TestCase
{
    use RefreshDatabase; 


    public function test_api_rechaza_peticiones_sin_token()
    {
        $response = $this->getJson('/api/perfumes');
        
        $response->assertStatus(401);
    }

    public function test_api_lista_perfumes_correctamente_con_token()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        Perfume::factory()->count(3)->create();

        $response = $this->getJson('/api/perfumes');

        $response->assertStatus(200)->assertJsonCount(3);
    }

    public function test_api_filtra_perfumes_por_parametro_search()
    {

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        Perfume::factory()->create(['nombre' => 'Bleu de Chanel']);
        Perfume::factory()->create(['nombre' => '212 VIP']);

        $response = $this->getJson('/api/perfumes?search=Bleu');

        $response->assertStatus(200)
                 ->assertJsonFragment(['nombre' => 'Bleu de Chanel'])
                 ->assertJsonMissing(['nombre' => '212 VIP']);
    }
}