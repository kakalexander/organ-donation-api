<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orgao;

class OrgaoController extends Controller
{
    public function store(Request $request)
    {
        // Valida os dados recebidos
        $validated = $request->validate([
            'nome_doador' => 'required|string|max:255',
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:500',
            'tipo' => 'required|in:Vital,Não Vital',
            'blood_type' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-,NÃO SEI',
            'sexo' => 'required|in:M,F,Outro',
        ]);

        // Salva os dados no banco
        $orgao = Orgao::create($validated);

        return response()->json(['message' => 'Órgão cadastrado com sucesso!', 'orgao' => $orgao], 201);
    }
}
