<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoricoColaboradorSetor extends Model
{
    use SoftDeletes;

    protected $table = 'historico_colaborador_setores';

    protected $fillable = [
        'setor_id',
        'nome_setor',
        'colaborador_id',
        'nome_colaborador',
        'data_entrada',
        'data_saida',
    ];

    public function setor()
    {
        return $this->belongsTo(Setor::class);
    }

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }


}
