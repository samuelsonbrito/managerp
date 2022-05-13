<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anexo extends Model
{
    use SoftDeletes;

    protected $table = 'anexos';

    protected  $fillable = [
        'nome',
        'url',
        'dependente_id',
        'colaborador_id',
        'contrato_id',
        'created_by',
        'updated_by'
    ];

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class);
    }
}
