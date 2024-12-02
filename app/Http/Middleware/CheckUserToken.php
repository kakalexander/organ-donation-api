<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserToken;

class CheckUserToken
{
    public function handle(Request $request, Closure $next)
    {
        $authorization = $request->header('Authorization');

        if (!$authorization || !str_starts_with($authorization, 'Bearer ')) {
            return response()->json(['message' => 'Token não fornecido.'], 401);
        }

        $token = substr($authorization, 7);

        $userToken = UserToken::where('token', $token)->first();

        if (!$userToken) {
            return response()->json(['message' => 'Token inválido ou expirado.'], 401);
        }

        // Define o usuário autenticado no request
        $request->setUserResolver(fn () => $userToken->user);

        return $next($request);
    }
}
