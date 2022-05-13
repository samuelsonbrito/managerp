<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnexoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (\Route::getCurrentRoute()->getName() == 'contrato.editar.anexo') {
            $rules = [
                'nome_anexo' => 'required',
            ];
        } else {
            $rules = [
                'nome' => 'required',
                'anexo' => 'required',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
        ];
    }

    public function attributes()
    {
        return [
            'nome' => 'Nome',
            'anexo' => 'Anexo',
            'nome_anexo' => 'Nome',
        ];
    }
}