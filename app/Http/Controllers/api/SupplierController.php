<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
   /**
     * @OA\Get(
     *     path="/api/suppliers",
     *     summary="Display a listing of all suppliers",
     *     tags={"Suppliers"},
     *     @OA\Response(
     *         response=200,
     *         description="List of suppliers",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="All suppliers")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $suppliers = Supplier::all();
        // Return a response, you can customize this based on your needs
        return response()->json(['message' => 'All suppliers', 'data' => $suppliers], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/suppliers",
     *     summary="Create a new supplier",
     *     tags={"Suppliers"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Name of the supplier",
     *                     example="Supplier Name"
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Supplier created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Supplier created successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object", example={"name": {"The name field is required."}})
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string',
        ]);

        // Create a new supplier instance and store it in the database
        $suppliers = Supplier::create([
            'name' => $request->input('name'),
        ]);

        // Return a response, you can customize this based on your needs
        return response()->json(['message' => 'Supplier created successfully', 'data' => $suppliers], 200);
    }


    /**
     * @OA\Get(
     *     path="/api/suppliers/{id}",
     *     summary="Display the specified supplier",
     *     tags={"Suppliers"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of the supplier",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Supplier details",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Supplier details")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Supplier not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Supplier not found")
     *         )
     *     )
     * )
     */
    public function show(string $id)
    {
        $suppliers = Supplier::find($id);

        if (!$suppliers) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        return response()->json(['message' => 'Supplier details', 'data' => $suppliers], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/suppliers/{id}",
     *     summary="Update the specified suppliers in storage",
     *     tags={"Suppliers"},
     *     @OA\Response(
     *         response=200,
     *         description="Supplier updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Supplier updated successfully"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Supplier not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Supplier not found"),
     *         )
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $suppliers = Supplier::find($id);

        if (!$suppliers) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        $suppliers->update($request->only(['name']));

        return response()->json(['message' => 'Supplier updated successfully', 'data' => $suppliers], 200);
    }


    /**
     * @OA\Delete(
     *     path="/api/suppliers/{id}",
     *     summary="Remove the specified supplier from storage",
     *     tags={"Suppliers"},
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of the supplier",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Supplier deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Supplier deleted successfully"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Supplier not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Supplier not found"),
     *         )
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        $supplier->delete();

        return response()->json(['message' => 'Supplier deleted successfully'], 200);
    }
}
