<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrequenciaEscala extends Model
{
    use SoftDeletes;

    protected $table = 'frequencias_escalas';

    protected $fillable = [
        'escala_id',
        'colaborador_id',
        'dia',
        'motivo_ausencia',
        'substituto_avulso',
        'substituto_extra',
        'tipo_substituto',
    ];

    public function colaborador()
    {
        $this->belongsTo(Colaborador::class);
    }


}
