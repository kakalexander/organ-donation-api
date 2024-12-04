<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\OrgaoController;
use App\Http\Controllers\SolicitationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

// Rotas públicas de autenticação
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rotas protegidas (Token Middleware)
Route::middleware(['App\Http\Middleware\CheckUserToken'])->group(function () {
    // Rotas do usuário autenticado
    Route::get('/dashboard', [DashboardController::class, 'getDashboardData']);

    Route::get('/user', function (\Illuminate\Http\Request $request) {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado'], 401);
        }
        return response()->json($user);
    });

    // Atualizar último login
    Route::post('/update-last-login', function (\Illuminate\Http\Request $request) {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado'], 401);
        }
        $user->update(['last_login' => now()]);
        return response()->json(['message' => 'Último login atualizado']);
    });

    // Rotas específicas para doadores
    Route::prefix('doador')->group(function () {
        Route::post('/orgaos', [OrgaoController::class, 'store']); // Cadastrar órgão
        Route::get('/orgaos', [OrgaoController::class, 'index']); // Listar órgãos doados pelo usuário
    });

    Route::prefix('receptor')->group(function () {
        Route::post('/solicitacoes', [SolicitationController::class, 'store']); // Criar solicitação
        Route::get('/solicitacoes', [SolicitationController::class, 'index']); // Listar solicitações do usuário
    });

    // Rotas específicas para administradores
    Route::prefix('admin')->group(function () {
        Route::get('/orgaos', [OrgaoController::class, 'listAll']); // Listar todos os órgãos
        Route::post('/usuarios', [UserController::class, 'store']); // Criar usuário
    });

    // Rotas para hospitais
    Route::apiResource('hospitals', HospitalController::class);

    // Rotas para solicitações de órgãos
    // Route::prefix('solicitations')->group(function () {
    //     Route::get('/', [SolicitationController::class, 'index']);
    //     Route::get('/{id}', [SolicitationController::class, 'show']);
    //     Route::post('/', [SolicitationController::class, 'store']);
    //     Route::delete('/{id}', [SolicitationController::class, 'destroy']);
    // });
});
