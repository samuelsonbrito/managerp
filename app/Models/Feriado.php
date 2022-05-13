<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feriado extends Model
{
    use SoftDeletes;

    protected $table = 'feriados';

    protected $fillable = [
        'descricao',
        'tipo',
        'data',
        'repetir_anualmente',
    ];

}
