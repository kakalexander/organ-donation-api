<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\OrgaoController;
use App\Http\Controllers\SolicitationController;
use App\Http\Controllers\DashboardController;

// Rotas públicas de autenticação
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rotas Protegidas (Token Middleware)
Route::middleware(['App\Http\Middleware\CheckUserToken'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'getDashboardData']);

Route::middleware(['App\Http\Middleware\CheckUserToken'])->group(function () {
     Route::get('/user', function (\Illuminate\Http\Request $request) {
        $user = $request->user(); // Obtém o usuário autenticado
        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado'], 401);
        }
        return response()->json($user); // Retorna os detalhes do usuário
    });
    
    // Atualizar último login
    Route::post('/update-last-login', function (\Illuminate\Http\Request $request) {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado'], 401);
        }
        $user->update(['last_login' => now()]);
            return response()->json(['message' => 'Last login updated']);
        });
    });
});
    

// Rotas para Hospitais
Route::apiResource('hospitals', HospitalController::class);

// Rotas para Órgãos
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('orgaos', OrgaoController::class);
});

// Rotas para Solicitações de Órgãos
Route::prefix('solicitations')->group(function () {
    Route::get('/', [SolicitationController::class, 'index']);
    Route::get('/{id}', [SolicitationController::class, 'show']);
    Route::post('/', [SolicitationController::class, 'store']);
    Route::delete('/{id}', [SolicitationController::class, 'destroy']);
});
