<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request; // Certifique-se de importar corretamente
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new user.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'blood_type' => 'required|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-,NÃO SEI',
            'birth_date' => 'required|date', // Valida a data de nascimento
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'blood_type' => $validated['blood_type'],
            'birth_date' => $validated['birth_date'], 
            'id_perfil' => 2, 
        ]);

        return response()->json([
            'message' => 'Usuário cadastrado com sucesso!',
            'user' => $user,
        ], 201);
    }

    /**
     * Login a user and return a token.
     */
    public function login(LoginRequest $request)
    {
        // Verificar credenciais e autenticar
        $request->authenticate();

        $user = Auth::user();

        // Gerar um token simples (ou JWT se necessário)
        $token = base64_encode($user->id . now()->timestamp);

        return response()->json([
            'message' => 'Login bem-sucedido!',
            'token' => $token,
            'user' => $user,
        ]);
    }
}
