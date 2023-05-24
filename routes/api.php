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

Route::get('/', function (Request $request) {
    return ["hello" => "world"];
});

Route::post("/login", [\App\Http\Controllers\AuthController::class, "login"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix("tasks")->group(function () {
        Route::get("/", [\App\Http\Controllers\TasksController::class, "index"]);
        Route::post("/", [\App\Http\Controllers\TasksController::class, "create"]);
        Route::put("/{task}", [\App\Http\Controllers\TasksController::class, "update"]);
        Route::delete("/{task}", [\App\Http\Controllers\TasksController::class, "delete"]);
    });
});
