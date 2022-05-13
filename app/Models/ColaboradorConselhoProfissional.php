<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ColaboradorConselhoProfissional extends Model
{
    use SoftDeletes;

    protected $table = 'colaboradores_conselhos_profissionais';

    protected $guarded = [];
    protected  $fillable = [
        'numero_conselho',
        'uf',
        'data_emissao',
        'data_validade',
        'colaborador_id',
        'conselho_id',
        'created_by',
        'updated_by'
    ];

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }
}
