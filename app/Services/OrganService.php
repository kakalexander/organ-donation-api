<?php

namespace App\Services;

use App\Models\Organ;

class OrganService
{
    public function getAllByUser($userId)
    {
        return Organ::where('user_id', $userId)->get();
    }

    public function create(array $data)
    {
        return Organ::create($data);
    }
}
