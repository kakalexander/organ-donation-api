<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\OrgaoController;
use App\Http\Controllers\SolicitationController;

// Rotas públicas de autenticação
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rota para cadastrar hospitais
Route::apiResource('hospitals', HospitalController::class);

// Cadastrar órgãos
Route::apiResource('orgaos', OrgaoController::class);

// Não pode ser editavel (não possui PUT OU PATCH) solicitações de orgãos
Route::prefix('solicitations')->group(function () {
    Route::get('/', [SolicitationController::class, 'index']);
    Route::get('/{id}', [SolicitationController::class, 'show']);
    Route::post('/', [SolicitationController::class, 'store']);
    Route::delete('/{id}', [SolicitationController::class, 'destroy']);
});

// Rotas protegidas
Route::middleware('App\Http\Middleware\CheckUserToken')->group(function () {
    Route::get('/user', function () {
        return response()->json(['message' => 'Access granted']);
    });
});
