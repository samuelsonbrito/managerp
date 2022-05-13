<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HorarioTabalhoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (\Route::getCurrentRoute()->getName() == 'horario-trabalho.update') {
            $rules = [
                'descricao_periodoEdit' => 'required',
                'inicio_expedienteEdit' => 'required|min:5',
                'fim_expedienteEdit' => 'required|min:5',
            ];
        } else {
            $rules = [
                'descricao_periodo' => 'required',
                'inicio_expediente' => 'required|min:5',
                'fim_expediente' => 'required|min:5',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'min:8' => 'O campo :attribute deve ter no mínimo 5 caracteres',
        ];
    }

    public function attributes()
    {
        if (\Route::getCurrentRoute()->getName() == 'horario-trabalho.update') {
            return [
                'descricao_periodoEdit' => 'Descrição',
                'inicio_expedienteEdit' => 'Inicio do Expediente',
                'fim_expedienteEdit' => 'Fim do Expediente',
            ];
        } else {

            return [
                'descricao_periodo' => 'Descrição',
                'inicio_expediente' => 'Inicio do Expediente',
                'fim_expediente' => 'Fim do Expediente',
            ];
        }
    }
}