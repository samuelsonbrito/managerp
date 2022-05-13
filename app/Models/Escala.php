<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Escala extends Model
{
    use SoftDeletes;

    protected $table = 'escalas';

    protected $fillable = [
        'periodo',
        'setor_id',
        'quantidade_dias',
        'cargo_id',
        'turno',
        'primeiro_dia',
        'unidade_id',
        'created_by',
        'updated_by',
    ];

    public function setor()
    {
        return $this->belongsTo(Setor::class);
    }
    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    public function colaboradores()
    {
        return $this->belongsToMany(
            Colaborador::class,
            'escalas_profissionais',
            'escala_id',
            'colaborador_id'
        )->withPivot('dias');
    }

}
