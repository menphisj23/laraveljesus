<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideojuegoController;
use App\Http\Controllers\PeliculaController;

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

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('videojuegos', [VideojuegoController::class, 'store']);
    Route::get('videojuegos', [VideojuegoController::class, 'index']);
    
    Route::post('peliculas', [PeliculaController::class, 'store']);
    Route::get('peliculas', [PeliculaController::class, 'index']);
});
