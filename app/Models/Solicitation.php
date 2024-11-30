<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'orgao_id',
        'user_id',
        'prazo',
        'tipo_sanguineo',
        'mensagem',
    ];

    /**
     * Relacionamento com o modelo Orgão.
     */
    public function orgao()
    {
        return $this->belongsTo(Orgao::class);
    }

    /**
     * Relacionamento com o modelo User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

