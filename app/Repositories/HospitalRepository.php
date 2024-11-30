<?php
namespace App\Repositories;

use App\Interfaces\HospitalRepositoryInterface;
use App\Models\Hospital;

class HospitalRepository implements HospitalRepositoryInterface
{
    public function all()
    {
        return Hospital::all();
    }

    public function find($id)
    {
        return Hospital::findOrFail($id);
    }

    public function create(array $data)
    {
        return Hospital::create($data);
    }

    public function update($id, array $data)
    {
        $hospital = $this->find($id);
        $hospital->update($data);
        return $hospital;
    }

    public function delete($id)
    {
        $hospital = $this->find($id);
        $hospital->delete();
        return true;
    }
}
