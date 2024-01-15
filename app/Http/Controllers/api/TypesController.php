<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;

class TypesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/types",
     *     summary="Display a listing of all types",
     *     tags={"Types"},
     *     @OA\Response(
     *         response=200,
     *         description="List of types",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="All types")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $types = Type::all();
        // Return a response, you can customize this based on your needs
        return response()->json(['message' => 'All types', 'data' => $types], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/types",
     *     summary="Create a new type",
     *     tags={"Types"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Name of the type",
     *                     example="Type Name"
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Type created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Type created successfully")
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

        // Create a new Type instance and store it in the database
        $type = Type::create([
            'name' => $request->input('name'),
        ]);

        // Return a response, you can customize this based on your needs
        return response()->json(['message' => 'Type created successfully', 'data' => $type], 200);
    }


    /**
     * @OA\Get(
     *     path="/api/types/{id}",
     *     summary="Display the specified type",
     *     tags={"Types"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of the type",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Type details",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Type details")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Type not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Type not found")
     *         )
     *     )
     * )
     */
    public function show(string $id)
    {
        $type = Type::find($id);

        if (!$type) {
            return response()->json(['message' => 'Type not found'], 404);
        }

        return response()->json(['message' => 'Type details', 'data' => $type], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/types/{id}",
     *     summary="Update the specified type in storage",
     *     tags={"Types"},
     *     @OA\Response(
     *         response=200,
     *         description="Type updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Type updated successfully"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Type not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Type not found"),
     *         )
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $type = Type::find($id);

        if (!$type) {
            return response()->json(['message' => 'Type not found'], 404);
        }

        $type->update($request->only(['name']));

        return response()->json(['message' => 'Type updated successfully', 'data' => $type], 200);
    }


    /**
     * @OA\Delete(
     *     path="/api/types/{id}",
     *     summary="Remove the specified type from storage",
     *     tags={"Types"},
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of the type",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Type deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Type deleted successfully"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Type not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Type not found"),
     *         )
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $type = Type::find($id);

        if (!$type) {
            return response()->json(['message' => 'Type not found'], 404);
        }

        $type->delete();

        return response()->json(['message' => 'Type deleted successfully'], 200);
    }

}
