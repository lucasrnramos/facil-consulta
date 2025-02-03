<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CidadesController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('usuario/registrar', [AuthController::class, 'register']);
Route::post('usuario/login', [AuthController::class, 'login']);

Route::get('/cidades', [CidadesController::class, 'retornaCidades']);
