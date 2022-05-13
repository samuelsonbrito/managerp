<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidade extends Model
{
    use SoftDeletes;

    protected $table = 'unidades';

    protected $fillable = [
        'nome',
        'created_by',
        'updated_by'
    ];

    public function setores()
    {
        return $this->hasMany(Setor::class, 'unidade_id');
    }

    public function contratos()
    {
        return $this->belongsToMany('App\Models\Contrato','contrato_unidade');
    }
}