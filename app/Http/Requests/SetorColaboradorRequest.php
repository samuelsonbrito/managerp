<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetorColaboradorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'colaborador' => 'required',
        ];

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
            'colaborador' => 'Colaborador',
        ];
    }
}