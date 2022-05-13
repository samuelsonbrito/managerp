<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model
{
    use SoftDeletes;
    protected $appends = ['valor_formatado'];

    protected $fillable = [
        'cliente_id',
        'numero',
        'data_inicial',
        'data_fim',
        'data_assinatura',
        'valor',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente');
    }
    public function unidades()
    {
        return $this->belongsToMany('App\Models\Unidade','contrato_unidade');
    }

    public function getValorFormatadoAttribute()
    {
        return 'R$ '.number_format($this->valor, 2, ',', '.');
    }

    public function getDataInicialAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d',$value)->format('d/m/Y');
    }

    public function getDataFimAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d',$value)->format('d/m/Y');
    }

    public function getDataAssinaturaAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d',$value)->format('d/m/Y');
    }

    public function setDataInicialAttribute($value)
    {
        $this->attributes['data_inicial'] = Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }

    public function setDataFimAttribute($value)
    {
        $this->attributes['data_fim'] = Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }
    public function setDataAssinaturaAttribute($value)
    {
        $this->attributes['data_assinatura'] = Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }

    public function anexos()
    {
        return $this->hasMany(Anexo::class, 'contrato_id');
    }
}
