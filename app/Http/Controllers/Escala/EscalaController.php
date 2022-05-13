<?php

namespace App\Http\Controllers\Escala;

use App\Http\Controllers\Controller;
use App\Models\{Cargo, Colaborador, Escala, Unidade};
use App\DataTables\EscalaDataTable;
use PDF;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use App\Services\EscalaService;
use Illuminate\Support\Facades\DB;

class EscalaController extends Controller
{
    private $escalaService;
    private $escalaDataTable;

    public function __construct(EscalaService $escalaService, EscalaDataTable $escalaDataTable)
    {
        $this->middleware('permissao-perfil:escala');
        $this->escalaService = $escalaService;
        $this->escalaDataTable = $escalaDataTable;
    }

    public function montarEscala()
    {
        $unidades = Unidade::all();
        $cargos = Cargo::all();
        $unidades = $unidades->pluck('nome', 'id')->toArray();
        $cargos = $cargos->pluck('descricao', 'id')->toArray();
        $meses_disponiveis = collect($this->escalaService->getMesesDias())->pluck('mes', 'id');

        return view('escalas.escala-gerar-index', compact('unidades', 'cargos', 'meses_disponiveis'));
    }

    public function consultarEscala()
    {
        return $this->escalaDataTable->render('escalas.escala-visualizar-index');
    }

    public function setoresUnidade(Request $request)
    {
        return $this->escalaService->getSetores($request->unidade);
    }

    public function montarEscalaMensal()
    {
        return view('escalas.escala-gerar');
    }

    public function cadastrarEscala(Request $request)
    {
        $result = $this->escalaService->salvarEscala($request->all());


        if (is_array($result)) {
            if ($result['status'] == "existe") {
                return redirect()->route('escala.editar', $result['escala_id']);
            }
        }

        if (!$result) {
            return redirect()->route('escala.montar-escala')
                ->with('error', 'Não é possível Cadastrar uma Escala sem Colaboradores!');
        }

        return redirect()->route('escala.salvar-escala', ['id' => $result->original['data']['dados']]);
    }

    public function salvarEscala($result)
    {
        $escala_id = $result;
        $escala = Escala::find($escala_id);
        if (count($escala->colaboradores) > 0) {
            return redirect()->route('escala.editar', $escala->id);
        }

        $colaboradores = $this->escalaService->getColaboradoresCargo($escala->cargo_id, $escala->setor_id);


        $dias_licencas = [];

        foreach ($colaboradores as $key => $colaborador) {
            $colaborador = Colaborador::find($colaborador->id);
            $dias_licencas[$key]['colaborador_id'] = $colaborador->id;
            $dias_licencas[$key]['dias'] = $this->escalaService->getDiasLicenca($escala->periodo, $colaborador->licencas);
        }

        $feriados = $this->escalaService->feriados($escala->periodo);

        return view('escalas.escala-gerar', compact('escala', 'colaboradores', 'dias_licencas', 'feriados'));
    }


    public function salvarDiaEscala(Request $request)
    {
        $escala = Escala::find($request->escala_id);

        foreach ($request->dia as $dias) {
            $colaborador = Colaborador::find($dias['colaborador_id']);

            $escalas_profissionais = DB::table('escalas_profissionais')->where('colaborador_id', $dias['colaborador_id'])->get();

//            foreach ($escalas_profissionais as $escala_profissional) {
//                foreach (array_filter(explode(',', $dias['dias'])) as $dia_selecionado) {
//                    foreach (array_filter(explode(',', $escala_profissional->dias)) as $dia) {
//                        if ($escala_profissional->escala_id == $request->escala_id) {
//                            if (($dia - $dia_selecionado) == -1 || ($dia - $dia_selecionado) == 1) {
//                                $result = "erro_dia_outra_escala";
//
//                            }
//                        } else {
//                            if (($dia - $dia_selecionado) == -1 || ($dia - $dia_selecionado) == 1 || ($dia - $dia_selecionado) == 0) {
//                                $result = "erro_dia_outra_escala";
//                            }
//
//                        }
//
//                    }
//                }
//
//            }
//            if (isset($result)) {
//                return $result;
//            }

//            dump($dias['colaborador_id']);
            if (array_key_exists("dias", $dias)) {
                $result = DB::table('escalas_profissionais')->where('colaborador_id', $colaborador->id)->where('escala_id', $escala->id)->select('dias')->get();

                if (count($result) == 0) {
                    $response = $escala->colaboradores()->attach($colaborador, ['dias' => $dias['dias']]);
                } elseif (count($result) >= 1) {
                    $response = $escala->colaboradores()->updateExistingPivot($colaborador, ['dias' => $dias['dias']]);
                }


            }
        }

        return $response;

    }

    public function excluirEscala(Request $request)
    {
        $dados = $this->escalaService->excluir($request->id);
        return redirect('escala')->with($dados->original['data']);
    }

    public function visualizarEscala($id)
    {
        $escala = Escala::find($id);
        $dias = [];
        $dias_selecionados = [];
        $dias_licencas = [];

        foreach ($escala->colaboradores as $key => $colaborador) {
            $dias_licencas[$key]['colaborador_id'] = $colaborador->id;
            $dias_licencas[$key]['dias'] = $this->escalaService->getDiasLicenca($escala->periodo, $colaborador->licencas);
        }

        $total_dia_plantoes = array_count_values($dias_selecionados);

        for ($i = 1; $i <= $escala->quantidade_dias; $i++) {

            $data = CarbonImmutable::createFromFormat('d/m/Y', $i . '/' . $escala->periodo);
            if (array_key_exists($i, $total_dia_plantoes)) {
                $dias[] = ['dia' => $i, 'nome_dia' => mb_strtoupper($data->isoFormat('ddd')), 'status' => '', 'inf_feriado' => '', 'total_plantoes' => $total_dia_plantoes[$i]];
            } else {
                $dias[] = ['dia' => $i, 'nome_dia' => mb_strtoupper($data->isoFormat('ddd')), 'status' => '', 'inf_feriado' => '', 'total_plantoes' => 0];
            }

        }

        $feriados = $this->escalaService->feriados($escala->periodo);

        return view('escalas.escala-visualizar')->with([
            'escala' => $escala,
            'dias' => $dias,
            'dias_licencas' => $dias_licencas,
            'feriados' => $feriados,
        ]);
    }

    public function imprimirEscala($id)
    {
        $escala = Escala::find($id);
        $dias = [];
        $dias_selecionados = [];
        foreach ($escala->colaboradores as $colaborador) {
            foreach (array_filter(explode(',', $colaborador->escalas->find($escala->id)->pivot->dias)) as $selecionado) {
                $dias_selecionados[] = $selecionado;
            }
        }

        $total_dia_plantoes = array_count_values($dias_selecionados);

        for ($i = 1; $i <= $escala->quantidade_dias; $i++) {
            $data = CarbonImmutable::createFromFormat('d/m/Y', $i . '/' . $escala->periodo);
            if (array_key_exists($i, $total_dia_plantoes)) {
                $dias[] = ['dia' => $i, 'nome_dia' => mb_strtoupper($data->isoFormat('ddd')), 'status' => '', 'feriado' => '', 'total_plantoes' => $total_dia_plantoes[$i]];
            } else {
                $dias[] = ['dia' => $i, 'nome_dia' => mb_strtoupper($data->isoFormat('ddd')), 'status' => '', 'feriado' => '', 'total_plantoes' => 0];
            }
        }

        $feriados = $this->escalaService->feriados($escala->periodo);

        $pdf = PDF::loadView('escalas.escala-imprimir', [
            'escala' => $escala,
            'dias' => $dias,
            'dias_selecionados' => array_count_values($dias_selecionados),
            'feriados' => $feriados
        ])->setPaper('a4', 'landscape');

        return $pdf->stream("escala.pdf", array("Attachment" => false));
    }

    public function editarEscala($escala_id)
    {
        $escala = Escala::find($escala_id);
        $dias = [];
        $dias_selecionados = [];

        $total_dia_plantoes = array_count_values($dias_selecionados);

        for ($i = 1; $i <= $escala->quantidade_dias; $i++) {

            $data = CarbonImmutable::createFromFormat('d/m/Y', $i . '/' . $escala->periodo);
            if (array_key_exists($i, $total_dia_plantoes)) {
                $dias[] = ['dia' => $i, 'nome_dia' => mb_strtoupper($data->isoFormat('ddd')), 'status' => '', 'total_plantoes' => $total_dia_plantoes[$i]];
            } else {
                $dias[] = ['dia' => $i, 'nome_dia' => mb_strtoupper($data->isoFormat('ddd')), 'status' => '', 'total_plantoes' => 0];
            }
        }

        $colaboradores = $this->escalaService->getColaboradoresCargo($escala->cargo_id, $escala->setor_id);

        $dias_licencas = [];

        foreach ($colaboradores as $colaborador) {
            $colaborador_model = Colaborador::find($colaborador->id);
            $result = $colaborador_model->escalas->find($escala->id);
            if (empty($result)) {
                $escala->colaboradores()->attach($colaborador_model, ['dias' => ',']);
            }
        }

        foreach ($colaboradores as $key => &$colaborador) {

            $colaborador_model = Colaborador::find($colaborador->id);
            $dias_licencas[$key]['colaborador_id'] = $colaborador_model->id;
            $dias_licencas[$key]['dias'] = $this->escalaService->getDiasLicenca($escala->periodo, $colaborador_model->licencas);
            $colaborador->dias_selecionados = array_filter(explode(',', $colaborador_model->escalas->find($escala->id)->pivot->dias));
            $colaborador->dias = $colaborador_model->escalas->find($escala->id)->pivot->dias;
        }

        $feriados = $this->escalaService->feriados($escala->periodo);

        return view('escalas.escala-editar')->with([
            'escala' => $escala,
            'colaboradores' => $colaboradores,
            'dias' => $dias,
            'dias_licencas' => $dias_licencas,
            'feriados' => $feriados,
        ]);
    }

    public function imprimirFrequenciaManual($id)
    {
        $escala = Escala::find($id);
        $dias = [];
        $dias_selecionados = [];
        foreach ($escala->colaboradores as $colaborador) {
            foreach (array_filter(explode(',', $colaborador->escalas->find($escala->id)->pivot->dias)) as $selecionado) {
                $dias_selecionados[] = $selecionado;
            }
        }

        $total_dia_plantoes = array_count_values($dias_selecionados);

        for ($i = 1; $i <= $escala->quantidade_dias; $i++) {
            $data = CarbonImmutable::createFromFormat('d/m/Y', $i . '/' . $escala->periodo);
            if (array_key_exists($i, $total_dia_plantoes)) {
                $dias[] = ['dia' => $i, 'nome_dia' => mb_strtoupper($data->isoFormat('ddd')), 'status' => '', 'feriado' => '', 'total_plantoes' => $total_dia_plantoes[$i]];
            } else {
                $dias[] = ['dia' => $i, 'nome_dia' => mb_strtoupper($data->isoFormat('ddd')), 'status' => '', 'feriado' => '', 'total_plantoes' => 0];
            }
        }

        $feriados = $this->escalaService->feriados($escala->periodo);

        $pdf = PDF::loadView('escalas.escala-imprimir-frequencia-manual', [
            'escala' => $escala,
            'dias' => $dias,
            'dias_selecionados' => array_count_values($dias_selecionados),
            'feriados' => $feriados
        ]);

        return $pdf->stream("escala.pdf", array("Attachment" => false));

    }

    public function imprimirAlimentacao($id)
    {
        $escala = Escala::find($id);
        $dias = [];
        $dias_selecionados = [];
        foreach ($escala->colaboradores as $colaborador) {
            foreach (array_filter(explode(',', $colaborador->escalas->find($escala->id)->pivot->dias)) as $selecionado) {
                $dias_selecionados[] = $selecionado;
            }
        }

        $total_dia_plantoes = array_count_values($dias_selecionados);

        for ($i = 1; $i <= $escala->quantidade_dias; $i++) {
            $data = CarbonImmutable::createFromFormat('d/m/Y', $i . '/' . $escala->periodo);
            if (array_key_exists($i, $total_dia_plantoes)) {
                $dias[] = ['dia' => $i, 'nome_dia' => mb_strtoupper($data->isoFormat('ddd')), 'status' => '', 'feriado' => '', 'total_plantoes' => $total_dia_plantoes[$i]];
            } else {
                $dias[] = ['dia' => $i, 'nome_dia' => mb_strtoupper($data->isoFormat('ddd')), 'status' => '', 'feriado' => '', 'total_plantoes' => 0];
            }
        }

        $feriados = $this->escalaService->feriados($escala->periodo);

        $pdf = PDF::loadView('escalas.escala-imprimir-alimentacao', [
            'escala' => $escala,
            'dias' => $dias,
            'dias_selecionados' => array_count_values($dias_selecionados),
            'feriados' => $feriados
        ]);

        return $pdf->stream("escala.pdf", array("Attachment" => false));

    }
}
