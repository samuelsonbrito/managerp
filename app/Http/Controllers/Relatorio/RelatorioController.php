<?php

namespace App\Http\Controllers\Relatorio;

use App\Http\Requests\SetorColaboradorRequest;
use App\Http\Requests\SetorRequest;
use App\Models\Setor;
use App\Models\Unidade;
use App\Services\RelatorioService;
use App\Http\Controllers\Controller;
use App\DataTables\RelatorioColaboradorSetoresDataTable;
use App\DataTables\ColaboradoresPorSetorDataTable;
use PDF;

class RelatorioController extends Controller
{
    private $relatorioColaboradorSetoresDataTable;
    private $relatorioService;
    private $colaboradoresPorSetorDataTale;

    public function __construct(RelatorioColaboradorSetoresDataTable $relatorioColaboradorSetoresDataTable, RelatorioService $relatorioService, ColaboradoresPorSetorDataTable $colaboradoresPorSetorDataTable)
    {
        $this->middleware('permissao-perfil:relatorio');
        $this->relatorioColaboradorSetoresDataTable = $relatorioColaboradorSetoresDataTable;
        $this->relatorioService = $relatorioService;
        $this->colaboradoresPorSetorDataTale = $colaboradoresPorSetorDataTable;
    }

    public function index()
    {
        return $this->relatorioColaboradorSetoresDataTable->render('relatorios.relatorio-colaborador-setores');
    }

    public function imprimirRelatorioColaboradorSetores($colaborador_id)
    {
        $query = $this->relatorioService->imprimirRelatorioColaboradorSetores($colaborador_id);

        $pdf = PDF::loadView('relatorios.impressao-relatorio-colaborador-setores', ['dados' => $query]);

        return $pdf->stream("relatorio-colaborador-setores.pdf", array("Attachment" => false));
    }

}
