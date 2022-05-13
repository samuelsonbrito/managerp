<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documento extends Model
{
    use SoftDeletes;

    protected $table = 'documentos';

    protected $fillable = [
        'colaborador_id',
        'rg',
        'orgao_emissor',
        'rg_data_emissao',
        'cpf',
        'pis',
        'data_inscricao_pis',
        'titulo_eleitor',
        'titulo_eleitor_zona',
        'titulo_eleitor_secao',
        'titulo_eleitor_uf',
        'ctps',
        'ctps_serie',
        'ctps_uf',
        'ctps_data_emissao',
        'certificado_reservista',
        'certificado_reservista_serie',
        'certificado_reservista_categoria',
        'cnh_numero',
        'cnh_categoria',
        'cnh_data_validade',
        'cnh_data_emissao',
        'created_by',
        'updated_by',
    ];

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }
    
}
