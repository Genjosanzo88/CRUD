<?php

namespace Tests\Feature\Api;

use App\Models\Material;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class MaterialsControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithoutMiddleware;

    /**
     * Test the index method of MaterialsController.
     *
     * @return void
     */
    public function testIndex()
    {
        // Arrange: Create materials in the database (use factory if needed)
        // Material::factory()->count(5)->create();

        // Act: Make a GET request to the index endpoint
        $response = $this->json('GET', '/api/materials');

        // Assert: Check if the response is successful and contains the expected data
        $response->assertStatus(200)
            ->assertJson(['message' => 'All materials'])
            ->assertJsonStructure(['message', 'data']);
    }

}
