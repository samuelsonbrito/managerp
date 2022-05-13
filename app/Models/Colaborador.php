<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Colaborador extends Model
{
    use SoftDeletes;

    protected $table = 'colaboradores';

    protected $fillable = [
        'nome',
        'matricula',
        'estado_civil',
        'nome_pai',
        'nome_mae',
        'data_nascimento',
        'local_nascimento',
        'estado_nascimento',
        'fone_contato',
        'nacionalidade',
        'grau_instrucao',
        'raca_cor',
        'residencia_propria',
        'recurso_fgts',
        'created_by',
        'updated_by'
    ];

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'colaborador_id');
    }

    public function dependentes()
    {
        return $this->hasMany(Dependente::class, 'colaborador_id');
    }

    public function frequencias()
    {
        return $this->hasMany(FrequenciaEscala::class, 'colaborador_id');
    }

    public function admissao()
    {
        return $this->hasOne(Admissao::class, 'colaborador_id');
    }

    public function documento()
    {
        return $this->hasOne(Documento::class, 'colaborador_id');
    }

    public function conselhoProfissional()
    {
        return $this->hasOne(ColaboradorConselhoProfissional::class, 'colaborador_id');
    }
    public function horarioTrabalhoIntervalo()
    {
        return $this->hasOne(ColaboradorHorarioTrabalhoIntervalo::class, 'colaborador_id');
    }
    public function anexos()
    {
        return $this->hasMany(Anexo::class, 'colaborador_id');
    }

    public function setores()
    {
        return $this->belongsToMany(
            Setor::class,
            'setores_profissionais',
            'colaborador_id',
            'setor_id'
        );
    }

    public function escalas()
    {
        return $this->belongsToMany(
            Escala::class,
            'escalas_profissionais',
            'colaborador_id',
            'escala_id'
        )->withPivot('dias');
    }

    public function licencas()
    {
        return $this->hasMany(LicencaColaborador::class, 'colaborador_id');
    }

}