<?php

namespace App\Http\Controllers\Feriado;

use App\Http\Requests\FeriadoRequest;
use App\Models\Unidade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\FeriadoDataTable;
use App\Services\FeriadoService;
use App\Http\Requests\UnidadeRequest;

class FeriadoController extends Controller
{
    private $feriadoDataTable;
    private $feriadoService;

    public function __construct(FeriadoDataTable $feriadoDataTable, FeriadoService $feriadoService)
    {
        $this->middleware('permissao-perfil:feriado');
        $this->feriadoDataTable = $feriadoDataTable;
        $this->feriadoService = $feriadoService;
    }

    public function index()
    {
        return $this->feriadoDataTable->render('feriado.feriado-index');
    }


    public function store(FeriadoRequest $request)
    {
        return $this->feriadoService->salvar($request->all());
    }


    public function destroy($id)
    {
        $dados = $this->feriadoService->excluir($id);
        return redirect('feriado')->with($dados->original['data']);
    }
}
