<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Valida apenas os campos que o usuário deve fornecer
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'blood_type' => 'required|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-,NAO SEI',
        ]);
    
        $defaultPerfilId = 2;
    
        // Cria o usuário com o perfil padrão
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'id_perfil' => $defaultPerfilId,
            'blood_type' => $validated['blood_type'], 
        ]);
    
        // Retorna a mensagem de sucesso junto com os dados do usuário
        return response()->json([
            'message' => 'Usuário cadastrado com sucesso!',
            'user' => $user
        ], 201);
    }
    

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = base64_encode($user->id . now()->timestamp); // Token simples
            return response()->json(['token' => $token, 'user' => $user], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
