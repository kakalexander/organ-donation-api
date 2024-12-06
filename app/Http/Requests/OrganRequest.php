<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Permitir a execução para usuários autenticados
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:500',
            'tipo' => 'required|in:Vital,Não Vital',
            'blood_type' => 'required|string|max:3',
            'sexo' => 'required|in:M,F,Outro',
        ];
    }
}
