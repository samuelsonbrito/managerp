<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endereco extends Model
{
    use SoftDeletes;

    protected $table = 'enderecos';

    protected $fillable = [
        'rua',
        'numero',
        'bairro',
        'complemento',
        'cep',
        'cidade',
        'uf',
        'colaborador_id',
        'created_by',
        'updated_by'
    ];

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }

}