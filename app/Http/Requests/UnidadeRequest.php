<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (\Route::getCurrentRoute()->getName() == 'unidade.update') {
            $rules = [
                'nomeEdit' => 'required',
            ];
        }else{
            $rules = [
                'nome' => 'required',
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
            'nomeEdit' => 'Nome',
        ];
    }
}