<?php

namespace Tests\Feature\Api;

use App\Models\Material;
use App\Models\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class TypeControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithoutMiddleware;

    /**
     * Test the index method of TypeController.
     *
     * @return void
     */
    public function testIndex()
    {
        // Arrange: Create types in the database (use factory if needed)
        // Material::factory()->count(5)->create();

        // Act: Make a GET request to the index endpoint
        $response = $this->json('GET', '/api/types');

        // Assert: Check if the response is successful and contains the expected data
        $response->assertStatus(200)
            ->assertJson(['message' => 'All types'])
            ->assertJsonStructure(['message', 'data']);
    }


    /**
     * Test the store method of TypeController for successful creation.
     *
     * @return void
     */
    public function testStoreSuccess()
    {
        // Arrange: Create data for a new type
        $typeData = [
            'name' => fake()->name()
        ];

        // Act: Make a POST request to the store endpoint
        $response = $this->json('POST', '/api/types', $typeData);

        // Assert: Check if the response is successful and contains the expected data
        $response->assertStatus(200)
            ->assertJson(['message' => 'Type created successfully'])
            ->assertJsonStructure(['message', 'data']);
    }

    /**
     * Test the delete method of TypeController for successful deletion.
     *
     * @return void
     */
    public function testDeleteSuccess()
    {
        // Arrange: Create a type in the database (use factory if needed)
        $type = Type::factory()->create();

        // Act: Make a DELETE request to the delete endpoint
        $response = $this->json('DELETE', "/api/types/{$type->id}");

        // Assert: Check if the response is successful and contains the expected data
        $response->assertStatus(200)
            ->assertJson(['message' => 'Type deleted successfully']);

        // Assert: Check if the type is no longer in the database
        $this->assertDatabaseMissing('types', ['id' => $type->id]);
    }
}
