<?php

namespace App\Repositories;

use App\Interfaces\OrgaoRepositoryInterface;
use App\Models\Orgao;

class OrgaoRepository implements OrgaoRepositoryInterface
{
    public function getAll()
    {
        return Orgao::all();
    }

    public function getById($id)
    {
        return Orgao::findOrFail($id);
    }

    public function create(array $data)
    {
        return Orgao::create($data);
    }

    public function update($id, array $data)
    {
        $orgao = $this->getById($id);
        $orgao->update($data);
        return $orgao;
    }

    public function delete($id)
    {
        $orgao = $this->getById($id);
        $orgao->delete();
        return true;
    }
}
