<?php

namespace App\Http\Controllers\Contrato;

use App\DataTables\ContratosDataTable;
use App\DataTables\ContratoAnexosDataTable;
use App\Http\Requests\{AnexoRequest, ContratoRequest};
use App\Models\Contrato;
use App\Services\ContratoService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContratoController extends Controller
{
    private $contratosDataTable;
    private $contratoAnexosDataTable;
    private $contratoService;

    public function __construct(ContratosDataTable $contratosDataTable, ContratoAnexosDataTable $contratoAnexosDataTable, ContratoService $contratoService)
    {
        $this->middleware('permissao-perfil:contrato');
        $this->contratosDataTable = $contratosDataTable;
        $this->contratoAnexosDataTable = $contratoAnexosDataTable;
        $this->contratoService = $contratoService;
    }

    public function contratoWidget(Request $request)
    {
       return($this->contratoService->getContratosInfo());
    }
    public function index()
    {

        return $this->contratosDataTable->render('contrato.contrato-index');
    }

    public function create()
    {
        return view('contrato.contrato-create');
    }

    public function store(ContratoRequest $request)
    {
        return $this->contratoService->salvarContrato($request->all());
    }

    public function show($id)
    {
        $dados = $this->contratoService->getDadosContrato($id);
        return view('contrato.contrato-visualizar', compact('dados'));
    }

    public function edit($id)
    {
        $dados = $this->contratoService->getDadosContrato($id);
        return view('contrato.contrato-create', compact('dados'));
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        $dados = $this->contratoService->excluir($id);
        return redirect('contratos')->with($dados->original['data']);
    }

    public function anexos($numero_contrato)
    {
        $contrato = Contrato::where('numero', $numero_contrato)->first();
        $numero_contrato = $contrato['numero'];
        $id = $contrato['id'];
        $query = $this->contratoService->anexosContratos($id);

        return $this->contratoAnexosDataTable->with('dados', $query)->render('contrato.contrato-anexos', compact('id', 'numero_contrato'));
    }

    public function cadastrarAnexo(AnexoRequest $request)
    {
        return $this->contratoService->cadastrarAnexo($request->all());
    }

    public function excluirAnexo($id)
    {
        $dados = $this->contratoService->excluirAnexo($id);
        return back()->with($dados->original['data']);
    }

    public function baixarAnexo($id)
    {
        return $this->contratoService->baixarAnexo($id);
    }

    public function editarAnexo(AnexoRequest $request)
    {
        return $this->contratoService->editarAnexo($request->all());
    }
}
