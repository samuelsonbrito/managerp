<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    { if (\Route::getCurrentRoute()->getName() == 'setor.update') {
        $rules = [
            'nomeEdit' => 'required',
            'insalubridadeEdit' => 'required',
            'unidadeEdit' => 'required',

        ];
    } else {
        $rules = [
            'nome' => 'required',
            'insalubridade' => 'required',
            'unidade' => 'required',
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
            'insalubridade' => 'Insalubridade',
            'unidade' => 'Unidade',
            'nomeEdit' => 'Nome',
            'insalubridadeEdit' => 'Insalubridade',
            'unidadeEdit' => 'Unidade',
        ];
    }
}