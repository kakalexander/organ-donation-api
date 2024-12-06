<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organ extends Model
{
    use HasFactory;

    protected $table = 'orgaos';

    protected $fillable = [
        'user_id',
        'nome_doador',
        'nome',
        'descricao',
        'tipo',
        'blood_type',
        'sexo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
