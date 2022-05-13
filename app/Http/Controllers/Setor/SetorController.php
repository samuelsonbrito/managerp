<?php

namespace App\Http\Controllers\Setor;

use App\Http\Requests\SetorColaboradorRequest;
use App\Http\Requests\SetorRequest;
use App\Models\Colaborador;
use App\Models\Setor;
use App\Models\Unidade;
use App\Services\SetorService;
use App\Http\Controllers\Controller;
use App\DataTables\SetorDataTable;
use App\DataTables\ColaboradoresPorSetorDataTable;
use Illuminate\Http\Request;


class SetorController extends Controller
{
    private $setorDataTable;
    private $setorService;
    private $colaboradoresPorSetorDataTale;

    public function __construct(SetorDataTable $setorDataTable, SetorService $setorService, ColaboradoresPorSetorDataTable $colaboradoresPorSetorDataTable)
    {
        $this->middleware('permissao-perfil:setor');
        $this->setorDataTable = $setorDataTable;
        $this->setorService = $setorService;
        $this->colaboradoresPorSetorDataTale = $colaboradoresPorSetorDataTable;
    }

    public function index()
    {
        $unidades = Unidade::all();
        $unidades = $unidades->pluck('nome', 'id')->toArray();
        return $this->setorDataTable->render('setor.setor-index', compact('unidades'));
    }

    public function create()
    {
        //
    }

    public function store(SetorRequest $request)
    {
        return $this->setorService->salvar($request->all());
    }

    public function show()
    {
        //
    }

    public function edit()
    {

    }

    public function update(SetorRequest $request)
    {
        return $this->setorService->update($request->all());
    }

    public function destroy($id)
    {
        $dados = $this->setorService->excluir($id);
        return redirect('setor')->with($dados->original['data']);
    }

    public function gerenciarColaboradores($setor_id)
    {
        $setor = Setor::find($setor_id);
        $id = $setor->id;
        $setor = $setor->nome;
        $query = $this->setorService->getColaboradores($setor_id);
        return $this->colaboradoresPorSetorDataTale->with('dados', $query)->render('setor.setor-colaboradores', compact('id', 'setor'));
    }

    public function getColaboradorAjax(Request $request)
    {

        $nome = $request->search;
        $colaboradores = $this->setorService->colaboradoresAjax($nome);
        $response = $colaboradores->count() > 0 ? $colaboradores->map(function ($item) {
            $cpf = $item->documento->cpf;
            return [
                'id' => $item->id,
                'text' => $item->nome .' - '. $cpf,
            ];
        }) : collect();

        return Response()->json($response, 200);
    }

    public function adicionarColaborador(SetorColaboradorRequest $request, $id)
    {
        return $this->setorService->adicionarColaborador($request->all(), $id);
    }

    public function removerColaborador($colaborador_id, $setor_id)
    {
        $dados = $this->setorService->removerColaborador($colaborador_id, $setor_id);
        return redirect()->route('setor.colaboradores', ['setor_id' => $setor_id])->with($dados->original['data']);
//        return redirect('setor.colaboradores')->with($dados->original['data']);
    }

}
