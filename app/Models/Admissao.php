<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admissao extends Model
{
    use SoftDeletes;

    protected $table = 'admissoes';

    protected $fillable = [
        'cargo_id',
        'colaborador_id',
        'data_admissao',
        'data_exame_admissional',
        'experiencia_id',
        'salario',
        'primeiro_emprego',
        'regime_trabalho',
        'vale_transporte_desconto',
        'readmissao',
        'contrato_registrado_outra_empresa',
        'created_by',
        'updated_by'
    ];

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }
}