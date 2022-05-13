<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dependente extends Model
{
    use SoftDeletes;

    protected $table = 'dependentes';

    protected $fillable = [
        'nome',
        'data_nascimento',
        'cpf',
        'colaborador_id',
        'created_by',
        'updated_by'
    ];

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }

    public function anexos()
    {
        return $this->hasMany(Anexo::class, 'dependente_id');
    }



}