<?php

namespace App\Http\Controllers;

use App\Models\Organ;
use Illuminate\Http\Request;

class OrganController extends Controller
{
    public function index(Request $request)
    {
        // Listar órgãos doados pelo usuário autenticado
        $organs = Organ::where('user_id', $request->user()->id)->get();

        return response()->json($organs, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:500',
            'tipo' => 'required|in:Vital,Não Vital',
            'blood_type' => 'required|string|max:3',
            'sexo' => 'required|in:M,F,Outro',
        ]);

        // Adicionar user_id e nome_doador automaticamente
        $organ = Organ::create(array_merge($validated, [
            'user_id' => $request->user()->id,
        ]));

        return response()->json($organ, 201);
    }
}
