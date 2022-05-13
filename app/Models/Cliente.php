<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'nome',
        'tipo_pessoa',
        'cpf_cnpj',
        'telefone',
        'nome_fantasia',
        'papel',
        'created_by',
        'updated_by'
    ];

    public function papeis()
    {
        return $this->belongsToMany('App\Models\Papel', 'contratos_papeis', 'papel_id', 'cliente_id');
    }

    public function contratos()
    {
        return $this->hasMany('App\Models\Contrato');
    }

}