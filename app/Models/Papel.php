<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Papel extends Model
{
    protected $fillable = ['descricao'];
    public $timestamps =false;
    protected $table = 'papeis';

    public function contratos()
    {
        $this->belongsToMany('App\Models\Papel','contratos_papeis','papel_id','cliente_id');
    }
}
