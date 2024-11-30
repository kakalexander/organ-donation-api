<?php

namespace App\Repositories;

use App\Interfaces\SolicitationRepositoryInterface;
use App\Models\Solicitation;

class SolicitationRepository implements SolicitationRepositoryInterface
{
    public function getAll()
    {
        return Solicitation::with(['orgao', 'user'])->get();
    }

    public function getById($id)
    {
        return Solicitation::with(['orgao', 'user'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Solicitation::create($data);
    }

    public function delete($id)
    {
        $solicitacao = Solicitation::findOrFail($id);
        $solicitacao->delete();
        return $solicitacao;
    }
}
