<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HorarioTrabalho extends Model
{
    use SoftDeletes;
    protected $appends = ['selected_name'];

    protected $table = 'horarios_trabalho';

    protected $fillable = [
        'descricao_periodo',
        'inicio_expediente',
        'fim_expediente',
        'created_by',
        'updated_by'
    ];

    public function getSelectedNameAttribute()
    {
        return "{$this->descricao_periodo} - {$this->inicio_expediente} às {$this->fim_expediente}";
    }

//    public function intervalos()
//    {
//        return $this->belongsToMany(
//            Intervalo::class,
//            'horarios_trabalho_intervalo',
//            'horario_trabalho_id',
//            'intervalo_id'
//        );
//    }
}
