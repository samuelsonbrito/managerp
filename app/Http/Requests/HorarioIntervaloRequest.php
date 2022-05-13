<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HorarioIntervaloRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if (\Route::getCurrentRoute()->getName() == 'horario-intervalo.update') {
            $rules = [
                'hora_inicialEdit' => 'required|min:5',
                'hora_finalEdit' => 'required|min:5',
            ];
        } else {
            $rules = [
                'hora_inicial' => 'required|min:5',
                'hora_final' => 'required|min:5',
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
        if (\Route::getCurrentRoute()->getName() == 'horario-intervalo.update') {
            return [
                'hora_inicialEdit' => 'Hora Inicial',
                'hora_finalEdit' => 'Hora Final',
            ];
        } else {
            return [
                'hora_inicial' => 'Hora Inicial',
                'hora_final' => 'Hora Final',
            ];
        }
    }
}