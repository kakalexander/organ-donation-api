<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'prazo' => 'required|string|max:255',
            'blood_type' => 'required|string|max:3',
            'mensagem' => 'nullable|string|max:500',
            'sexo' => 'required|string|max:10',
            'telefone' => 'required|string|max:15',
            'endereco' => 'required|string|max:255',
            'status' => 'nullable|string|max:255',
        ];
    }
}
