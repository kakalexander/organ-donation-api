<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orgao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_doador',
        'nome',
        'descricao',
        'tipo',
        'blood_type',
        'sexo',
    ];
}

