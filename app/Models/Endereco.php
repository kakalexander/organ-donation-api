<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'rua',
        'cidade',
        'estado',
        'cep',
    ];

    /**
     * Relacionamento com User.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'id_endereco');
    }
}
