<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orgao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'tipo',
        'tipo_sanguineo',
        'sexo',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'usuarios_orgaos', 'id_orgao', 'id_user')
                    ->withPivot('tipo') // Tipo do vínculo (doador/receptor)
                    ->withTimestamps();
    }
}
