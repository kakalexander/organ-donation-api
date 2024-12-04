<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitation;

class SolicitationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'prazo' => 'required|string|max:255',
            'mensagem' => 'required|string|max:500',
        ]);

        $solicitation = Solicitation::create([
            'nome' => $validated['nome'],
            'prazo' => $validated['prazo'],
            'mensagem' => $validated['mensagem'],
            'user_id' => $request->user()->id, // Relacionar ao usuário autenticado
        ]);

        return response()->json([
            'message' => 'Solicitação criada com sucesso!',
            'solicitation' => $solicitation,
        ], 201);
    }

    public function index(Request $request)
    {
        $solicitations = Solicitation::where('user_id', $request->user()->id)->get();

        return response()->json($solicitations);
    }
}
