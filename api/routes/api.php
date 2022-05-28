<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    /**
     * Authentication routes
     */
    Route::post('/', function(){
        return response()->json(["msg" => "Correct path"], 200);
    });

    /**
     * User management routes
     */
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    /**
     * Group management routes
     */
});

Route::fallback(function() {
    return response()->json(["msg" => "Path not found"], 404);
});