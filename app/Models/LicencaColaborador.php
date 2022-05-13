<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LicencaColaborador extends Model
{
    use SoftDeletes;

    protected $table = 'licenca_colaboradors';

    protected $fillable = [
        'colaborador_id',
        'licenca_id',
        'inicio',
        'fim',
    ];

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }

    public function licenca()
    {
        return $this->belongsTo(Licenca::class);
    }
}
