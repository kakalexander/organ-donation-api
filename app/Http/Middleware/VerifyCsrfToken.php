<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/*', // Exclui todas as rotas no grupo 'api'
        '/register', // Exclui a rota de registro (caso esteja fora de 'api')
        '/login',    // Exclui a rota de login (caso esteja fora de 'api')
    ];
}
