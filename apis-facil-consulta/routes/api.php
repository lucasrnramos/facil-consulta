<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CidadesController;
use App\Http\Controllers\MedicosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PacientesController;


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

// Rotas cidades;
Route::group(['prefix' => 'cidades'], function () {
    Route::get('/{nome?}', [CidadesController::class, 'show']);
    Route::get('/{id_cidade}/medicos/{nome?}', [MedicosController::class, 'showByCity']);
});

// Rotas médicos;
Route::group(['prefix' => 'medicos'], function () {

    Route::get('/{nome?}', [MedicosController::class, 'show']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/consulta', [MedicosController::class, 'store']);
        Route::get('/{id_medico}/pacientes/{apenas_agendadas?}/{nome?}', [MedicosController::class, 'showByPatient']);
    });

});

// Rotas pacientes;
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/pacientes/{id_paciente}', [PacientesController::class, 'update']);
    Route::post('/pacientes', [PacientesController::class, 'store']);
});
