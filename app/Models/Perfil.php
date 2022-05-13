<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfis';

    protected $fillable = [
        'descricao',
    ];

    public function modulos()
    {
        return $this->belongsToMany(
            Modulo::class,
            'perfis_modulos',
            'perfil_id',
            'modulo_id'
        )->withPivot('cadastrar', 'editar', 'visualizar', 'excluir');
    }
}
