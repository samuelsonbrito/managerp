<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ColaboradorHorarioTrabalhoIntervalo extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    protected $table = 'horarios_trabalho_intervalos';

    protected $fillable = [
        'i_trabalho_id',
        'h_trabalho_id',
        'data_registro',
        'colaborador_id'
    ];

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }

    public function intervalo()
    {
        return $this->belongsTo(Intervalo::class);
    }

    public function horarioTrabalho()
    {
        return $this->belongsTo(HorarioTrabalho::class, 'h_trabalho_id');
    }

}
