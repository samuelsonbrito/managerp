<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property  nome
 */
class Setor extends Model
{
    use SoftDeletes;

    protected $table = 'setores';

    protected $fillable = [
        'nome',
        'unidade_id',
        'insalubridade',
        'created_by',
        'updated_by'
    ];

    public function unidade()
    {
        $this->belongsTo(Unidade::class);
    }

    public function colaboradores()
    {
        return $this->belongsToMany(
            Colaborador::class,
            'setores_profissionais',
            'setor_id',
            'colaborador_id'
        );
    }
}