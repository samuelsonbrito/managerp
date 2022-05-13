<?php

namespace App\Services;

use App\Models\HistoricoColaboradorSetor;

class RelatorioService
{
    public function imprimirRelatorioColaboradorSetores($colaborador_id)
    {
        $historicos = HistoricoColaboradorSetor::where('colaborador_id', $colaborador_id)->get();

        $historicos = collect($historicos)->map(function ($item) {
            $item['data_entrada'] = bdToBr($item['data_entrada']);
            $item['data_saida'] = bdToBr($item['data_saida']);
            return $item;

        });

        return $historicos;
    }
}