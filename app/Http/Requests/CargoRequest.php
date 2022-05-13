<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CargoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (\Route::getCurrentRoute()->getName() == 'cargo.update') {
            $rules = [
                'descricaoEdit' => 'required',
            ];
        } else {
            $rules = [
                'descricao' => 'required',
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
            'descricao' => 'Nome',
            'descricaoEdit' => 'Nome',
        ];
    }
}