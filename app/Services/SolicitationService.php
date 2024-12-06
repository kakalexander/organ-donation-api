<?php

namespace App\Services;

use App\Models\Solicitation;

class SolicitationService
{
    public function getAllByUser($userId)
    {
        return Solicitation::where('user_id', $userId)->get();
    }

    public function create(array $data)
    {
        return Solicitation::create($data);
    }
}
