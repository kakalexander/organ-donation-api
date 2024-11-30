<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Orgao;

class DashboardController extends Controller
{
    public function getDashboardData(Request $request)
    {
        $user = $request->user();
        $perfil = $user->id_perfil;

        // Dados para Administrador
        if ($perfil == 1) {
            return response()->json([
                'orgaos' => [
                    'total' => Orgao::count(),
                    'ultimas_24h' => Orgao::where('created_at', '>=', now()->subDay())->count(),
                    'ultimos_7_dias' => Orgao::where('created_at', '>=', now()->subDays(7))->count(),
                    'detalhes' => Orgao::latest()->take(10)->get(),
                ],
                'usuarios' => [
                    'total' => User::count(),
                    'ativos_24h' => User::where('last_login', '>=', now()->subDay())->count(),
                    'ultimo_doador' => User::where('tipo_cadastro', 'Doador')->latest()->first(),
                    'ultimo_receptor' => User::where('tipo_cadastro', 'Receptor')->latest()->first(),
                    'ultimo_online' => User::latest('last_login')->first(),
                ],
                'hospitais' => [
                    'total' => 40, // Placeholder
                    'grandes' => 2, // Placeholder
                ],
            ]);
        }

        // Dados para Receptor
        if ($perfil == 2) {
            return response()->json([
                'mensagem' => 'Dados exclusivos para Receptor',
            ]);
        }

        // Dados para Doador
        if ($perfil == 3) {
            return response()->json([
                'mensagem' => 'Dados exclusivos para Doador',
            ]);
        }

        return response()->json(['mensagem' => 'Perfil não reconhecido'], 403);
    }
}
