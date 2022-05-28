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
    Route::post('/auth', [AuthController::class, "auth"])->name('auth');

    Route::middleware(['auth:sanctum', 'checkusecasepermissions'])->group(function () {
        /**
         * User management routes
         */
        Route::prefix('/user')->group(function () {
            Route::post('/add', [UserController::class, "add"])->name('adduser');
            Route::post('/delete/{id}', [UserController::class, "delete"])->name('deleteuser');
    
            //Bonus routes :)
            Route::get('/whoami', [UserController::class, "whoami"])->name('whoami');
            Route::post('/logout', [UserController::class, "logout"])->name('logout');
        });
    
        /**
         * Group management routes
         */
        Route::prefix('/group')->group(function () {
            Route::post('/add', [GroupController::class, "add"])->name('addgroup');
            Route::post('/delete/{id}', [GroupController::class, "delete"])->name('deletegroup');
            Route::post('/{id}/add/{user_id}', [GroupController::class, "addToGroup"])->name('addToGroup');
            Route::post('/{id}/remove/{user_id}', [GroupController::class, "removeFromGroup"])->name('removeFromGroup');
        });
    });
});

Route::fallback(function(){
    return response()->json(["msg" => "Path doesn't exist"], 404);
});