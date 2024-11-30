<?php

namespace App\Http\Controllers;

use App\Interfaces\SolicitationRepositoryInterface;
use Illuminate\Http\Request;

class SolicitationController extends Controller
{
    protected $repository;

    public function __construct(SolicitationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return response()->json($this->repository->getAll(), 200);
    }

    public function show($id)
    {
        return response()->json($this->repository->getById($id), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'orgao_id' => 'required|exists:orgaos,id',
            'user_id' => 'required|exists:users,id',
            'prazo' => ['required', 'string', 'regex:/^\d+ dias$/'],
            'tipo_sanguineo' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-, NÃO SEI',
            'mensagem' => 'nullable|string|max:500',
        ]);

        $solicitacao = $this->repository->create($data);

        return response()->json([
            'message' => 'Solicitação criada com sucesso!',
            'solicitacao' => $solicitacao,
        ], 201);
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return response()->json(['message' => 'Solicitação excluída com sucesso!'], 200);
    }
}
