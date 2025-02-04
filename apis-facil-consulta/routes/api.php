<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CidadesController;
use App\Http\Controllers\MedicosController;
use App\Http\Controllers\AuthController;


Route::group([
    'middleware' => 'api',
    'prefix'     => 'auth'
    ], function ($router) {
        Route::post('/login',       [AuthController::class, 'login']);
        Route::post('/register',    [AuthController::class, 'register']);
        Route::post('/logout',      [AuthController::class, 'logout']);
        Route::post('/refresh',     [AuthController::class, 'refresh']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
        Route::post('/verify',      [AuthController::class, 'verify']);
});


Route::get('/login', function () {
    return response()
        ->json([
            'status' => 401,
            'error'  => 'Não autenticado!'
        ], 401);

})->name('login');


Route::post('usuario/registrar', [AuthController::class, 'register']);
Route::post('usuario/login',     [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
});

Route::get('/cidades/{nome?}', [CidadesController::class, 'show']);
Route::get('/cidades/{id_cidade}/medicos/{nome?}', [MedicosController::class, 'showByCity']);
Route::get('/medicos/{nome?}', [MedicosController::class, 'show']);
