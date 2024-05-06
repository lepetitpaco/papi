<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpendingController;
use App\Http\Controllers\Auth\ApiAuthController;

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


Route::get('/test', function () {
    return response()->json(['message' => 'This is a test API endpoint']);
});

Route::get('/db-test', function () {
    try {
        \DB::connection()->getPdo();
        return response()->json(['message' => 'Successfully connected to the database.']);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to connect to the database: ' . $e->getMessage()]);
    }
});

Route::post('/login', [ApiAuthController::class, 'login']);

// JSON API
Route::middleware('auth:sanctum')->group(function () {
    // Protected API routes
    Route::get('/spendings', [SpendingController::class, 'index']);
    Route::post('/spendings', [SpendingController::class, 'store']);
});