<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckUserToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token || !DB::table('user_tokens')->where('token', $token)->exists()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
