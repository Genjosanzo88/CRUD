<?php

use App\Http\Controllers\api\EnviormentalController;
use App\Http\Controllers\api\MaterialsController;
use App\Http\Controllers\api\SupplierController;
use App\Http\Controllers\api\TypesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('types', TypesController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('enviormentals', EnviormentalController::class);
Route::resource('materials', MaterialsController::class);
