<?php

namespace Tests\Feature;

use App\Models\Profil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use ApiPlatform\Laravel\Test\ApiTestAssertionsTrait;

class ProfilTest extends TestCase
{
    use RefreshDatabase, ApiTestAssertionsTrait;

    /**
     * Test to fetch the collection of Profils.
     */
    public function testGetCollection(): void
    {
        // Create 10 Profils using the factory
        try {
            Profil::factory()->count(10)->create();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        // Send a GET request to the collection endpoint
        $response = $this->withHeaders(['Accept' => 'application/ld+json','X-Requested-With' => 'XMLHttpRequest',])->get('/api/profils?page=1');
        // Assert that the response is successful (200 OK)
        $response->assertStatus(200);

        // Check the Content-Type header
        $response->assertHeader('Content-Type', 'application/ld+json; charset=utf-8');

        // Assert the returned JSON contains the expected structure using assertJsonContains from the trait
        $this->assertJsonContains([
            '@context' => '/api/contexts/Profil',
            '@id' => '/api/profils',
            '@type' => 'Collection',
        ], $response->json());
        
        $activeprofil = Profil::where('statut','actif' )->get()->count();
        // paginaion par defulk = 30
        $this->assertEquals($activeprofil, $response->json('totalItems'));
    }


}
