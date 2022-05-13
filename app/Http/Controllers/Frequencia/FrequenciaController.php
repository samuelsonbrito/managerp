<?php

namespace App\Http\Controllers\Frequencia;

use App\DataTables\FrequenciaDataTable;
use App\Http\Controllers\Controller;
use App\Models\{Cargo, Unidade};
use App\Services\FrequenciaService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class FrequenciaController extends Controller
{
    private $frequenciaService;
    private $frequenciaDataTable;

    public function __construct(FrequenciaDataTable $frequenciaDataTable, FrequenciaService $frequenciaService)
    {
        $this->middleware('permissao-perfil:frequencia');
        $this->frequenciaService = $frequenciaService;
        $this->frequenciaDataTable = $frequenciaDataTable;
    }

    public function index()
    {
        $unidades = Unidade::all();
        $unidades = $unidades->pluck('nome', 'id')->toArray();

        return view('frequencia.frequencia-index', compact('unidades'));
    }

    public function show($id)
    {
    }

    public function gerarFrequencia(Request $request)
    {
        $result = $this->frequenciaService->gerarFrequencias($request->all());

        return redirect()->route('frequencia.gerenciar-frequencias', [
            'periodo' => $result->original['data']['dados']['periodo'],
            'dia' => $result->original['data']['dados']['dia'],
            'unidade' => $result->original['data']['dados']['unidade'],
            'turno' => $result->original['data']['dados']['turno'],
        ]);
    }

    public function gerenciarFrequencias($periodo, $dia, $unidade, $turno)
    {
        $nome_unidade = Unidade::find($unidade)->nome;
        $data = Carbon::createFromFormat('m-Y', $periodo)->format($dia . '/m/Y');
        $query = $this->frequenciaService->getFrequencias($periodo, $dia, $unidade);
        return $this->frequenciaDataTable->with('dados', $query)->render('frequencia.frequencia-gerenciar', compact(
            'data',
            'turno',
            'nome_unidade',
            'periodo',
            'dia',
            'unidade'
        ));
    }

    public function update(Request $request)
    {
        return $this->frequenciaService->update($request->all());
    }

    public function reverterFrequencia($id)
    {
        $dados = $this->frequenciaService->reverterFrequencia($id);
        return redirect()->back()->with($dados->original['data']);
    }

    public function inicioRelatorio()
    {
        $unidades = Unidade::all()->pluck('nome', 'id')->toArray();
        $cargos = Cargo::all()->pluck('descricao', 'id')->toArray();

        return view('frequencia.frequencia-relatorio', compact('unidades', 'cargos'));
    }

    public function gerarRelatorio(Request $request)
    {
        $dados = $this->frequenciaService->gerarRelatorio($request->all());
        return view('frequencia.frequencia-visualizar-relatorio', compact('dados'));
    }

    public function imprimirRelatorio($data, $unidade, $turno, $cargo)
    {
        $dados = [
            'data' => str_replace('-', '/', $data),
            'unidade' => $unidade,
            'turno' => $turno,
            'cargo' => $cargo
        ];

        $dados = $this->frequenciaService->imprimirRelatorio($dados);

        $pdf = PDF::loadView('frequencia.frequencia-imprimir-relatorio', [
            'dados' => $dados,
        ]);

        return $pdf->stream("frequencia.pdf", array("Attachment" => false));
    }

}
