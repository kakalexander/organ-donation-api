<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organ;

class DashboardController extends Controller
{
    /**
     * Obtém os dados do dashboard com base no perfil do usuário.
     */
    public function getDashboardData(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Usuário não autenticado.'], 401);
        }

        $perfil = $user->id_perfil;

        switch ($perfil) {
            case 1: // Administrador
                return $this->getAdminDashboardData();
            case 2: // Receptor
                return $this->getReceptorDashboardData();
            case 3: // Doador
                return $this->getDoadorDashboardData();
            default:
                return response()->json(['mensagem' => 'Perfil não reconhecido'], 403);
        }
    }

    /**
     * Dados do Dashboard para Administrador.
     */
    private function getAdminDashboardData()
    {
        return response()->json([
            'orgaos' => $this->getOrgaoData(),
            'usuarios' => $this->getUserData(),
            'hospitais' => $this->getHospitalData(),
        ]);
    }

    /**
     * Dados do Dashboard para Receptor.
     */
    private function getReceptorDashboardData()
    {
        return response()->json([
            'mensagem' => 'Dados exclusivos para Receptor',
        ]);
    }

    /**
     * Dados do Dashboard para Doador.
     */
    private function getDoadorDashboardData()
    {
        return response()->json([
            'mensagem' => 'Dados exclusivos para Doador',
        ]);
    }

    /**
     * Obtém os dados sobre órgãos.
     */
    private function getOrgaoData()
    {
        return [
            'total' => Organ::count(),
            'ultimas_24h' => Organ::where('created_at', '>=', now()->subDay())->count(),
            'ultimos_7_dias' => Organ::where('created_at', '>=', now()->subDays(7))->count(),
            'detalhes' => Organ::with('user:id,name,blood_type') 
                ->latest()
                ->take(10)
                ->get(['id', 'nome', 'tipo', 'blood_type', 'sexo', 'created_at', 'user_id']),
        ];
    }
    
    
    

    /**
     * Obtém os dados sobre usuários.
     */
    private function getUserData()
    {
        return [
            'total' => User::count(),
            'ativos_24h' => User::where('last_login', '>=', now()->subDay())->count(),
            'ultimo_doador' => User::where('tipo_cadastro', 'doador')->latest()->first(['id', 'name', 'email', 'created_at']),
            'ultimo_receptor' => User::where('tipo_cadastro', 'receptor')->latest()->first(['id', 'name', 'email', 'created_at']),
            'ultimo_online' => User::latest('last_login')->first(['id', 'name', 'last_login']),
        ];
    }

    /**
     * Obtém os dados sobre hospitais (placeholders).
     */
    private function getHospitalData()
    {
        return [
            'total' => 40, // Placeholder
            'grandes' => 2, // Placeholder
        ];
    }
}
