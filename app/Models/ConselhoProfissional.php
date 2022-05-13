<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConselhoProfissional extends Model
{
    use SoftDeletes;

    protected $table = 'conselhos_profissionais';

    protected  $fillable = [
        'nome',
        'created_by',
        'updated_by',
    ];

}
