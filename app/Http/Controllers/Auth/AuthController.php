<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register a new user.
     */
    public function register(RegisterRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $user = $this->authService->register([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
                'blood_type' => $validatedData['blood_type'],
                'birth_date' => $validatedData['birth_date'] ?? null,
                'tipo_cadastro' => $validatedData['tipo_cadastro'], 
            ]);
    
            return response()->json([
                'message' => 'Usuário cadastrado com sucesso!',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao cadastrar o usuário.',
                'error' => $e->getMessage(),
            ], 400);
        }
    }
    
    /**
     * Login a user and return a token.
     */
    public function login(LoginRequest $request)
    {
        try {
            $token = $this->authService->login($request->validated());

            return response()->json([
                'message' => 'Login bem-sucedido!',
                'token' => $token,
                'user' => Auth::user(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao fazer login.',
                'error' => $e->getMessage(),
            ], $e->getCode() ?: 400);
        }
    }
}
