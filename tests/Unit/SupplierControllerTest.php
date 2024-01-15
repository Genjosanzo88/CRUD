<?php

namespace Tests\Feature\Api;

use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class SupplierControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithoutMiddleware;

    /**
     * Test the index method of TypeController.
     *
     * @return void
     */
    public function testIndex()
    {
        // Arrange: Create suppliers in the database (use factory if needed)
        // Supplier::factory()->count(5)->create();

        // Act: Make a GET request to the index endpoint
        $response = $this->json('GET', '/api/suppliers');

        // Assert: Check if the response is successful and contains the expected data
        $response->assertStatus(200)
            ->assertJson(['message' => 'All suppliers'])
            ->assertJsonStructure(['message', 'data']);
    }


    /**
     * Test the store method of SupplierController for successful creation.
     *
     * @return void
     */
    public function testStoreSuccess()
    {
        // Arrange: Create data for a new supplier
        $supplierData = [
            'name' => fake()->name()
        ];

        // Act: Make a POST request to the store endpoint
        $response = $this->json('POST', '/api/suppliers', $supplierData);

        // Assert: Check if the response is successful and contains the expected data
        $response->assertStatus(200)
            ->assertJson(['message' => 'Supplier created successfully'])
            ->assertJsonStructure(['message', 'data']);
    }

    /**
     * Test the delete method of SupplierController for successful deletion.
     *
     * @return void
     */
    public function testDeleteSuccess()
    {
        // Arrange: Create a supplier in the database (use factory if needed)
        $supplier = Supplier::factory()->create();

        // Act: Make a DELETE request to the delete endpoint
        $response = $this->json('DELETE', "/api/suppliers/{$supplier->id}");

        // Assert: Check if the response is successful and contains the expected data
        $response->assertStatus(200)
            ->assertJson(['message' => 'Supplier deleted successfully']);

        // Assert: Check if the supplier is no longer in the database
        $this->assertDatabaseMissing('suppliers', ['id' => $supplier->id]);
    }
}
