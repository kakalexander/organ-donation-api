<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitation;

class SolicitationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $solicitations = Solicitation::where('user_id', $user->id)->get();
        return response()->json($solicitations, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'prazo' => 'required|string|max:255',
            'blood_type' => 'required|string|max:3',
            'mensagem' => 'nullable|string|max:500',
            'sexo' => 'required|string|max:10',
            'telefone' => 'required|string|max:15',
            'endereco' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        $user = $request->user();

        $solicitation = Solicitation::create([
            'user_id' => $user->id,
            'nome' => $request->nome,
            'prazo' => $request->prazo,
            'blood_type' => $request->blood_type,
            'mensagem' => $request->mensagem,
            'sexo' => $request->sexo,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
            'status' => 'pendente',
        ]);

        return response()->json($solicitation, 201);
    }
}
