<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\OrgaoController;
use App\Http\Controllers\SolicitationController;
use App\Http\Controllers\DashboardController;

// Rotas públicas de autenticação
// Rotas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rota protegida para atualizar o último login
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/update-last-login', function (\Illuminate\Http\Request $request) {
        $user = $request->user(); // Obtem o usuário autenticado
        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado'], 401);
        }
        $user->update(['last_login' => now()]);
        return response()->json(['message' => 'Last login updated']);
    });
    Route::get('/dashboard', [DashboardController::class, 'getDashboardData']);
});


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
