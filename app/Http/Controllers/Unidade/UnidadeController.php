<?php

namespace App\Http\Controllers\Unidade;

use App\Models\Unidade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\UnidadeDataTable;
use App\Services\UnidadeService;
use App\Http\Requests\UnidadeRequest;

class UnidadeController extends Controller
{
    private $unidadeDataTable;
    private $unidadeService;

    public function __construct(UnidadeDataTable $unidadeDataTable, UnidadeService $unidadeService)
    {
        $this->middleware('permissao-perfil:unidade');
        $this->unidadeDataTable = $unidadeDataTable;
        $this->unidadeService = $unidadeService;
    }

    public function index()
    {
        return $this->unidadeDataTable->render('unidade.unidade-index');
    }

    public function create()
    {
        //
    }

    public function store(UnidadeRequest $request)
    {
        return $this->unidadeService->salvar($request->all());
    }

    public function show()
    {
        //
    }

    public function edit()
    {

    }

    public function update(UnidadeRequest $request)
    {
        return $this->unidadeService->update($request->all());
    }

    public function destroy($id)
    {
        $dados = $this->unidadeService->excluir($id);
        return redirect('unidade')->with($dados->original['data']);
    }
}
