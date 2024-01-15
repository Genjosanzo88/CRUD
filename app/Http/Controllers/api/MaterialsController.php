<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/materials",
     *     summary="Display a listing of all materials",
     *     tags={"Materials"},
     *     @OA\Response(
     *         response=200,
     *         description="List of materials",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="All materials")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $materials = Material::all();
        return response()->json(['message' => 'All materials', 'data' => $materials], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *     path="/api/materials",
     *     summary="Create a new material",
     *     tags={"Materials"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="name", type="string", description="Name of the material", example="Material Name"),
     *                 @OA\Property(property="id_type", type="integer", description="ID of the material type", example=1),
     *                 @OA\Property(property="id_env_impact", type="integer", description="ID of the environmental impact", example=1),
     *                 @OA\Property(property="id_supplier", type="integer", description="ID of the supplier", example=1),
     *                 @OA\Property(property="cost", type="string", description="Cost of the material", example="100.00"),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Material created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Material created successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Material"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object"),
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        // Validate and debug
        $request->validate([
            'name' => 'required|string',
            'id_type' => 'required|integer|exists:types,id',
            'id_env_impact' => 'required|integer|exists:envioramental_impact,id',
            'id_supplier' => 'required|integer|exists:suppliers,id',
            'cost' => 'required|string',
        ]);

        // Debugging
        \Log::info('Request data:', $request->all());

        try {
            // Create a new Material instance and store it in the database
            $material = Material::create($request->all());

            // Debugging
            \Log::info('Material created:', $material->toArray());

            // Return a response
            return response()->json(['message' => 'Material created successfully', 'data' => $material], 201);
        } catch (\Exception $e) {
            // Log the exception for further investigation
            \Log::error('Error creating material: ' . $e->getMessage());

            // Return an error response
            return response()->json(['message' => 'Error creating material'], 500);
        }
    }



    /**
     * @OA\Get(
     *     path="/api/materials/{id}",
     *     summary="Display the specified material",
     *     tags={"Materials"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of the material",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Material details",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Material details"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Material not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Material not found")
     *         )
     *     )
     * )
     */
    public function show(string $id)
    {
        $materials = Material::find($id);

        if (!$materials) {
            return response()->json(['message' => 'Material not found'], 404);
        }

        return response()->json(['message' => 'Material details', 'data' => $materials], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @OA\Put(
     *     path="/api/materials/{id}",
     *     summary="Update the specified material",
     *     tags={"Materials"},
     *     @OA\Response(
     *         response=200,
     *         description="Material updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Material updated successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Material"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Material not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Material not found"),
     *         )
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
            'id_type' => 'required|integer|exists:types,id',
            'id_env_impact' => 'required|integer|exists:envioramental_impact,id',
            'id_supplier' => 'required|integer|exists:suppliers,id',
            'cost' => 'required|string',
        ]);

        $material = Material::find($id);

        if (!$material) {
            return response()->json(['message' => 'Material not found'], 404);
        }

        // Update the material in the database
        $material->update($request->all());

        // Return a response
        return response()->json(['message' => 'Material updated successfully', 'data' => $material], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/materials/{id}",
     *     summary="Remove the specified material from storage",
     *     tags={"Materials"},
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of the material",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Materials deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Materials deleted successfully"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Materials not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Materials not found"),
     *         )
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $materials = Material::find($id);

        if (!$materials) {
            return response()->json(['message' => 'Material not found'], 404);
        }

        $materials->delete();

        return response()->json(['message' => 'Material deleted successfully'], 200);
    }
}
