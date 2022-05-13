<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Cargo extends Model
{
    use SoftDeletes;

    protected $table = 'cargos';
    protected $fillable = [
        'descricao',
        'created_at',
        'updated_at'
    ];
}
