<?php

namespace App\Http\Controllers;

use App\Interfaces\OrgaoRepositoryInterface;
use Illuminate\Http\Request;

class OrgaoController extends Controller
{
    private $orgaoRepository;

    public function __construct(OrgaoRepositoryInterface $orgaoRepository)
    {
        $this->orgaoRepository = $orgaoRepository;
    }

    public function index()
    {
        $orgaos = $this->orgaoRepository->getAll();
        return response()->json($orgaos);
    }

    public function show($id)
    {
        $orgao = $this->orgaoRepository->getById($id);
        return response()->json($orgao);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:500',
            'tipo' => 'nullable|string| in:Vital,Não Vital',
            'tipo_sanguineo' => 'nullable|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'sexo' => 'nullable|in:M,F,Outro',
        ]);

        $orgao = $this->orgaoRepository->create($validated);

        return response()->json($orgao, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nome' => 'string|max:255',
            'descricao' => 'string|max:500',
            'tipo' => 'nullable|string| in:Vital,Não Vital',
            'tipo_sanguineo' => 'nullable|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-, NÃO SEI',
            'sexo' => 'nullable|in:M,F,Outro',
        ]);

        $orgao = $this->orgaoRepository->update($id, $validated);

        return response()->json($orgao);
    }

    public function destroy($id)
    {
        $this->orgaoRepository->delete($id);

        return response()->json(['message' => 'Órgão deletado com sucesso']);
    }
}
