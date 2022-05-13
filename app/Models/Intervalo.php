<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intervalo extends Model
{
    use SoftDeletes;

    protected $table = 'intervalos';

    protected $guarded = [];

//    public function horariosTrabalho()
//    {
////        return $this->belongsToMany(
////            Intervalo::class,
////            'horarios_trabalho_intervalo',
////            'intervalo_id',
////            'horarios_trabalho_id'
////        );
//    }
}
