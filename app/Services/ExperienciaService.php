<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ExperienciaService
{
    public function getExpericiencias()
    {
        $experiencias = DB::table('experiencias')->get();
        $experiencias = $experiencias->pluck('descricao', 'id');

        return $experiencias;
    }
}