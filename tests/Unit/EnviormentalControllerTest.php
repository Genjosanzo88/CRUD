<?php

namespace Tests\Feature\Api;

use App\Models\Envioramental_impact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class EnviormentalControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithoutMiddleware;

    /**
     * Test the index method of TypeController.
     *
     * @return void
     */
    public function testIndex()
    {
        // Arrange: Create envioramental impact in the database (use factory if needed)
        // Envioramental_impact::factory()->count(5)->create();

        // Act: Make a GET request to the index endpoint
        $response = $this->json('GET', '/api/enviormentals');

        // Assert: Check if the response is successful and contains the expected data
        $response->assertStatus(200)
            ->assertJson(['message' => 'All enviormental impacts'])
            ->assertJsonStructure(['message', 'data']);
    }


    /**
     * Test the store method of EnviormentalController for successful creation.
     *
     * @return void
     */
    public function testStoreSuccess()
    {
        // Arrange: Create data for a new enviormentals
        $enviormentalsData = [
            'name' => fake()->name()
        ];

        // Act: Make a POST request to the store endpoint
        $response = $this->json('POST', '/api/enviormentals', $enviormentalsData);

        // Assert: Check if the response is successful and contains the expected data
        $response->assertStatus(200)
            ->assertJson(['message' => 'Enviormental impact created successfully'])
            ->assertJsonStructure(['message', 'data']);
    }

    /**
     * Test the delete method of EnviormentalController for successful deletion.
     *
     * @return void
     */
    public function testDeleteSuccess()
    {
        // Arrange: Create a enviormental in the database (use factory if needed)
        $enviormental = Envioramental_impact::factory()->create();

        // Act: Make a DELETE request to the delete endpoint
        $response = $this->json('DELETE', "/api/enviormentals/{$enviormental->id}");

        // Assert: Check if the response is successful and contains the expected data
        $response->assertStatus(200)
            ->assertJson(['message' => 'Enviormental impact deleted successfully']);

        // Assert: Check if the enviormental is no longer in the database
        $this->assertDatabaseMissing('envioramental_impact', ['id' => $enviormental->id]);
    }
}
