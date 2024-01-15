<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Envioramental_impact;
use Illuminate\Http\Request;

class EnviormentalController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/enviormentals",
     *     summary="Display a listing of all enviormental impacts",
     *     tags={"Enviormental impacts"},
     *     @OA\Response(
     *         response=200,
     *         description="List of enviormental impacts",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="All enviormental impacts")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $enviormentals = Envioramental_impact::all();
        // Return a response, you can customize this based on your needs
        return response()->json(['message' => 'All enviormental impacts', 'data' => $enviormentals], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/enviormentals",
     *     summary="Create a new enviormental impact",
     *     tags={"Enviormental impacts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Name of the enviormental impact",
     *                     example="Impact Name"
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Enviormental impact created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Enviormental impact created successfully")
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

        // Create a new enviormental impact instance and store it in the database
        $enviormentals = Envioramental_impact::create([
            'name' => $request->input('name'),
        ]);

        // Return a response, you can customize this based on your needs
        return response()->json(['message' => 'Enviormental impact created successfully', 'data' => $enviormentals], 200);
    }


    /**
     * @OA\Get(
     *     path="/api/enviormentals/{id}",
     *     summary="Display the specified enviormental impact",
     *     tags={"Enviormental impacts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of the enviormental impact",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Enviormental impact details",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Enviormental impact details")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Enviormental impact not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Enviormental impact not found")
     *         )
     *     )
     * )
     */
    public function show(string $id)
    {
        $enviormentals = Envioramental_impact::find($id);

        if (!$enviormentals) {
            return response()->json(['message' => 'Enviormental impact not found'], 404);
        }

        return response()->json(['message' => 'Enviormental impact details', 'data' => $enviormentals], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/enviormentals/{id}",
     *     summary="Update the specified enviormental impact in storage",
     *     tags={"Enviormental impacts"},
     *     @OA\Response(
     *         response=200,
     *         description="Enviormental impact updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Enviormental impact updated successfully"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Enviormental impact not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Enviormental impact not found"),
     *         )
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $enviormentals = Envioramental_impact::find($id);

        if (!$enviormentals) {
            return response()->json(['message' => 'Enviormental impact not found'], 404);
        }

        $enviormentals->update($request->only(['name']));

        return response()->json(['message' => 'Enviormental impact updated successfully', 'data' => $enviormentals], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/enviormentals/{id}",
     *     summary="Remove the specified enviormental impact from storage",
     *     tags={"Enviormental impacts"},
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id of the enviormental impact",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Enviormental impact deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Enviormental impact deleted successfully"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Enviormental impact not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Enviormental impact not found"),
     *         )
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $enviormentals = Envioramental_impact::find($id);

        if (!$enviormentals) {
            return response()->json(['message' => 'Enviormental impact not found'], 404);
        }

        $enviormentals->delete();

        return response()->json(['message' => 'Enviormental impact deleted successfully'], 200);
    }
}
