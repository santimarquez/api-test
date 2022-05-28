<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;

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
    Route::post('/auth', [AuthController::class, "auth"]);

    Route::middleware('auth:sanctum')->group(function () {
        /**
         * User management routes
         */
        Route::prefix('/user')->group(function () {
            Route::post('/add', [UserController::class, "add"]);
            Route::post('/delete/{id}', [UserController::class, "delete"]);
    
            //Bonus routes :)
            Route::get('/whoami', [UserController::class, "whoami"]);
            Route::post('/logout', [UserController::class, "logout"]);
        });
    
        /**
         * Group management routes
         */
        Route::prefix('/group')->group(function () {
            Route::post('/add', [GroupController::class, "add"]);
            Route::post('/delete/{id}', [GroupController::class, "delete"]);
            Route::post('/{id}/add/{user_id}', [GroupController::class, "addToGroup"]);
            Route::post('/{id}/remove/{user_id}', [GroupController::class, "removeFromGroup"]);
        });
    });
});

Route::fallback(function(){
    return response()->json(["msg" => "Path doesn't exist"], 404);
});