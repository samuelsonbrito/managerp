<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeriadoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'descricao' => 'required',
            'tipo' => 'required',
            'data_feriado' => 'required',
            'repetir_anualmente' => 'required',
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
            'descricao' => 'Descrição',
            'tipo' => 'Tipo',
            'data_feriado' => 'Data',
            'repetir_anualmente' => 'Repetir Anualmente',
        ];
    }
}