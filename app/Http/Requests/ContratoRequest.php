<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContratoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(\Route::getCurrentRoute()->getName() == 'contrato.update') {
            $rules = [

            ];
        } else {
            $rules = [
                'valor' => 'required',
                'data_inicial' =>'required',
                'data_final'   =>'required',
                'unidades.0'   =>'required',
                'cliente'   =>'required',
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
            'valor' => 'Valor do Contrato',
            'data_inicial' => 'Data Inicial',
            'data_final' => 'Data Final',
            'unidades' => 'Unidade(s)',
            'cliente' => 'Cliente',

        ];
    }
}
