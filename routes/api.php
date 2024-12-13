<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\OrganController;
use App\Http\Controllers\SolicitationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

// Rotas públicas de autenticação
Route::post('/register', [AuthController::class, 'register']); // Cadastro
Route::post('/login', [AuthController::class, 'login']); // Login

// Rotas protegidas (Token Middleware)
Route::middleware(['App\Http\Middleware\CheckUserToken'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'getDashboardData']);
    Route::get('/user', fn (\Illuminate\Http\Request $request) => response()->json($request->user()));

    // Atualizar último login
    Route::post('/update-last-login', function (\Illuminate\Http\Request $request) {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado'], 401);
        }
        $user->update(['last_login' => now()]);
        return response()->json(['message' => 'Último login atualizado']);
    });

    Route::middleware(['App\Http\Middleware\CheckUserToken'])->group(function () {
        Route::prefix('doador')->group(function () {
            Route::get('/orgaos', [OrganController::class, 'index']); // Listar órgãos doados pelo usuário
            Route::post('/orgaos', [OrganController::class, 'store']); // Novo método para usuários
        });
    
        Route::prefix('admin')->group(function () {
            Route::get('/orgaos', [OrganController::class, 'listAll']); // Admin lista todos os órgãos
            Route::post('/orgaos', [OrganController::class, 'store']); // Admin cadastra órgãos
            Route::post('/users', [UserController::class, 'store']); // Admin cadastra usuários
        });

        Route::prefix('receptor')->group(function () {
            Route::get('/solicitations', [SolicitationController::class, 'index']); // Listar solicitações do usuário
            Route::post('/solicitations', [SolicitationController::class, 'store']); // Nova solicitação
        });
    });

    // Rotas para hospitais
    Route::apiResource('hospitals', HospitalController::class); // CRUD de hospitais

});
