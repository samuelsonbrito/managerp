<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $table = 'modulos';

    protected $fillable = [
        'modulo',
        'chave',
        'descricao',
    ];

    public function perfis()
    {
        return $this->belongsToMany(
            Perfil::class,
            'perfis_modulos',
            'modulo_id',
            'perfil_id'
        );
    }
}
