<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'id_endereco', 
        'id_perfil',
        'blood_type',
        'tipo_cadastro',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Relacionamento com Endereco.
     */
    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'id_endereco');
    }
}
