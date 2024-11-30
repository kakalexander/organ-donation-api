<?php
namespace App\Interfaces;

interface SolicitationRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function delete($id);
}
