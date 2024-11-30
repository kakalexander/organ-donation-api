<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $table = 'hospitals'; // Nome correto da tabela
    protected $fillable = ['name', 'address', 'phone']; // Campos permitidos para inserção
}

