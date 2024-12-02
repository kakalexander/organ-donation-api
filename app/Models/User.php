<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_date',
        'email',
        'password',
        'id_endereco',
        'id_perfil',
        'tipo_cadastro',
        'blood_type',
        'last_login',
    ];

    protected $hidden = ['password', 'remember_token'];

    public function tokens(): HasMany
    {
        return $this->hasMany(UserToken::class, 'user_id');
    }
}
