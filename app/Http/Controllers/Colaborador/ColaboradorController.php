<?php

namespace App\Http\Controllers\Colaborador;

use App\DataTables\ColaboradorDataTable;
use App\DataTables\ColaboradorAnexosDataTable;
use App\DataTables\DependentesDataTable;
use App\DataTables\LicencasDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColaboradorRequest;
use App\Models\Unidade;
use Illuminate\Http\Request;
use App\Services\DepartamentoServices;
use App\Services\PaisEstadoCidadeService;
use App\Repositories\ConselhoProfissional\ConselhoProfissionalRepositoryEloquent as ConselhoProfissionalRepository;
use App\Services\ColaboradorService;
use App\Services\ExperienciaService;
use Illuminate\Support\Facades\DB;
use PDF;

class ColaboradorController extends Controller
{
    private $departamentoServices;
    private $colaboradorDataTable;
    private $colaboradorAnexosDataTable;
    private $paisesEstadosCidadesService;
    private $conselhoProfissionalRepository;
    private $colaboradorService;
    private $experienciaService;
    private $dependenteDataTable;
    private $licencaDataTable;

    function __construct(

        DepartamentoServices $departamentoServices,
        ColaboradorDataTable $colaboradorDataTable,
        ColaboradorAnexosDataTable $colaboradorAnexosDataTable,
        PaisEstadoCidadeService $paisesEstadosCidadesService,
        ConselhoProfissionalRepository $conselhoProfissionalRepository,
        ColaboradorService $colaboradorService,
        ExperienciaService $experienciaService,
        LicencasDataTable $licencaDataTable,
        DependentesDataTable $dependenteDataTable
    )
    {
        $this->middleware('permissao-perfil:colaborador');
        $this->departamentoServices = $departamentoServices;
        $this->colaboradorDataTable = $colaboradorDataTable;
        $this->colaboradorAnexosDataTable = $colaboradorAnexosDataTable;
        $this->paisesEstadosCidadesService = $paisesEstadosCidadesService;
        $this->conselhoProfissionalRepository = $conselhoProfissionalRepository;
        $this->colaboradorService = $colaboradorService;
        $this->experienciaService = $experienciaService;
        $this->dependenteDataTable = $dependenteDataTable;
        $this->licencaDataTable = $licencaDataTable;
    }

    public function index()
    {
        return $this->colaboradorDataTable->render('colaborador.colaborador-index');
    }

    public function create()
    {
        $unidades = Unidade::all();
        $unidades = $unidades->pluck('nome', 'id')->toArray();
        $experiencias = $this->experienciaService->getExpericiencias();
        $conselhos = $this->conselhoProfissionalRepository->getConselhos();
        $paises = $this->paisesEstadosCidadesService->getPaises();
        $estados = $this->paisesEstadosCidadesService->getEstados();

        return view('colaborador.colaborador-create', compact('paises', 'estados', 'conselhos', 'experiencias', 'unidades'));
    }

    public function store(ColaboradorRequest $request)
    {
        if ($request->colaborador_id) {
            return $this->colaboradorService->update($request->all());
        } else {
            return $this->colaboradorService->salvar($request->all());
        }
    }

    public function show($id)
    {
        $data = $this->dadosParaViewCreateEditShow($id);
        return view('colaborador.colaborador-visualizar')->with($data);

    }

    public function edit($id)
    {
        $data = $this->dadosParaViewCreateEditShow($id);
        return view('colaborador.colaborador-create')->with($data);
    }

    public function destroy($id)
    {
        $dados = $this->colaboradorService->excluir($id);
        return redirect('colaborador')->with($dados->original['data']);
    }

    private function dadosParaViewCreateEditShow($id)
    {
        $experiencias = $this->experienciaService->getExpericiencias();
        $conselhos = $this->conselhoProfissionalRepository->getConselhos();
        $paises = $this->paisesEstadosCidadesService->getPaises();
        $estados = $this->paisesEstadosCidadesService->getEstados();
        $colaborador = $this->colaboradorService->editar($id);
        $cargos = DB::table('cargos')->get();
        $cargos = $cargos->pluck('descricao', 'id');

        $data = [
            'experiencias' => $experiencias,
            'conselhos' => $conselhos,
            'paises' => $paises,
            'estados' => $estados,
            'cargos' => $cargos,
            'colaborador' => $colaborador
        ];

        return $data;
    }

    public function imprimirShow($id)
    {
        $experiencias = $this->experienciaService->getExpericiencias();
        $conselhos = $this->conselhoProfissionalRepository->getConselhos();
        $colaborador = $this->colaboradorService->editar($id);
        $cargos = DB::table('cargos')->get();
        $cargos = $cargos->pluck('descricao', 'id');

        $pdf = PDF::loadView('colaborador.colaborador-imprimir', [
            'colaborador' => $colaborador,
            'experiencias' => $experiencias,
            'conselhos' => $conselhos,
            'cargos' => $cargos,
        ]);
        return $pdf->stream("colaborador.pdf", array("Attachment" => false));
    }

    public function verificaCpfExistente(Request $request)
    {
        return $this->colaboradorService->verificaCpf($request->cpf);
    }

    public function licencas($id)
    {
        $licencas = DB::table('licencas')->get();
        $licencas = $licencas->pluck('tipo', 'id');
        $query = $this->colaboradorService->licencas($id);
        return $this->licencaDataTable->with('dados', $query)->render('colaborador.colaborador-licenca', compact('id', 'licencas'));
    }

    public function dependentes($id)
    {
        $query = $this->colaboradorService->dependentes($id);
        return $this->dependenteDataTable->with('dados', $query)->render('colaborador.colaborador-dependentes', compact('id'));
    }
    public function cadastrarDependente(Request $request)
    {
        return $this->colaboradorService->cadastrarDependente($request->all());
    }

    public function cadastrarLicenca(Request $request)
    {
        return $this->colaboradorService->cadastrarLicenca($request->all());
    }

    public function excluirDependente($id)
    {
        $dados = $this->colaboradorService->excluirDependente($id);
        return back()->with($dados->original['data']);
    }

    public function excluirLicenca($id)
    {
        $dados = $this->colaboradorService->excluirLicenca($id);
        return back()->with($dados->original['data']);
    }

    public function anexos($id)
    {
        $query = $this->colaboradorService->anexosDependentes($id);
        return $this->colaboradorAnexosDataTable->with('dados', $query)->render('colaborador.colaborador-anexos', compact('id'));
    }

    public function baixarAnexo($id)
    {
        return $this->colaboradorService->baixarAnexo($id);
    }

    public function excluirAnexo($id)
    {
        $dados = $this->colaboradorService->excluirAnexo($id);
        return back()->with($dados->original['data']);
    }

    public function editarAnexo(Request $request)
    {
        return $this->colaboradorService->editarAnexo($request->all());
    }

    public function editarDependente(Request $request)
    {
        return $this->colaboradorService->editarDependente($request->all());
    }

    public function ajaxAnexosDependentes($id)
    {
        $query = $this->colaboradorService->anexosDependentes($id);
        return $this->colaboradorAnexosDataTable->with('dados', $query)->ajax();
    }

    public function cadastrarAnexo(Request $request)
    {
        return $this->colaboradorService->cadastrarAnexo($request->all());
    }
}